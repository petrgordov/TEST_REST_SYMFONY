<?php

namespace App\RestApi;

use App\Catalog\Pricing;
use App\Entity\Cart;
use App\Entity\Coupons;
use App\Entity\Order;
use App\Entity\Products;
use App\PaymentProcessor\PayData;
use App\PaymentProcessor\Payment;
use App\Validator as TaxAssert;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;

class Api
{

    #[TaxAssert\ConstraintTaxNumber(mode: 'loose')]
    private string $taxNumber;


    public function __construct(private ManagerRegistry $doctrine, private ValidatorInterface $validator)
    {
    }

    public function __call(string $name, array $arguments): JsonResponse
    {
        return $this->responseErr([
            'message' => 'Error call method: ' . $name
        ]);
    }

    public function Product(int $id, string $taxNumber): JsonResponse
    {

        try {

            if ($id == 0) {
                return $this->responseErr([
                    'message' => 'The product Not found'
                ]);
            }

            if ($taxNumber) {
                $this->taxNumber = $taxNumber;
                $errors = $this->validator->validate($this);
                if (count($errors) > 0) {
                    return $this->responseErr(['message' => $errors[0]->getMessage()]);
                }
            }

            $em = $this->doctrine->getRepository(Products::class);
            $product = $em->findInfoByProduct($id);

            if (!$product) {
                throw new \Exception();
            }

            // Получаем цену товара с учётом налогов
            $product[0]['price'] = Pricing::Price($product[0]['price'], $taxNumber);

            return $this->responseOk($product[0]);

        } catch (\Exception $e) {

            return $this->responseErr([
                'status' => 400,
                'errors' => 'Not found product for id ' . $id,
            ]);

        }

    }

    public function Order(): JsonResponse
    {


        $this->doctrine->getConnection()->beginTransaction();

        try {

            $data = $this->transformJsonBody(new Request());

            if (!$data || !$data->request->get('product') || !$data->request->get('paymentProcessor')) {
                throw new \Exception();
            }

            //формирование заказа
            //+++++++++++++++++++

            //информация по товару

            $taxNumber = $data->request->get('taxNumber');
            $idProduct = $data->request->get('product');

            $product = $this->doctrine->getRepository(Products::class)
                ->findInfoByProduct($idProduct);

            if (!$product) {
                throw new \Exception();
            }

            $this->taxNumber = $taxNumber;
            $quantity = (int)$data->request->get('quantity');
            $paymentProcessor = $data->request->get('paymentProcessor');
            $couponCode = $data->request?->get('couponCode');

            $errors = $this->validator->validate($this);

            if (count($errors) > 0) {
                throw new \Exception($errors[0]->getMessage());
            }

            //нельзя заказать больше чем есть на остатке или 0

            if ($quantity > $product[0]['deposit']) {
                throw new \Exception('You cannot order more than what is available.');
            } else if ($quantity === 0) {
                throw new \Exception('Please, select quantity more then zero');
            }

            //
            $order = new Order();
            $order->setTaxNumber($taxNumber);
            $order->setDate(new \DateTime('now'));
            $order->setCountry(Pricing::Country($taxNumber));
            $order->setPaymentProcessor($paymentProcessor);
            $order->setIdUser(1);//for sample
            $order->setIsPay(0);
            $order->setTax(Pricing::CountryTax($taxNumber));

            $uuid = Uuid::v4();
            $order->setHash($uuid);

            if ($couponCode) {
                //так как кол-во купонов может быть очень большим то делаем выборку из базы
                $coupon = $this->doctrine->getRepository(Coupons::class)
                    ->findInfoByCouponCode($couponCode);

                if (!$coupon) {
                    throw new \Exception('couponCode not Found');
                }

                $order->setCouponCode($couponCode);
                $order->setCouponeDiscount($coupon[0]->getVal());
                $order->setTypeDiscount($coupon[0]->getTypecoupon());

            }

            $errors = $this->validator->validate($order);

            if (count($errors) > 0) {
                throw new \Exception($errors[0]->getMessage());
            }

            //продолжаем создавать заказ

            $em = $this->doctrine->getManager();
            $em->persist($order);
            $em->flush();
            $OrderId = $order->getId();

            //добавление товара в корзину
            $cart = new Cart();
//            dump($quantity);
            $cart->setQuantity($quantity);
            $cart->setCouponCode($couponCode)->setIdOrder($OrderId)->setIdProduct($idProduct);

            $cart->setPriceBase($product[0]['price']);//чистая цена товара
            $cart->setPriceTax(Pricing::Price($product[0]['price'], $taxNumber));//цена с налогом без скидок

            //цена для покупателя
            $cart->setPrice(
                Pricing::FinalPrice(
                    $cart->getPriceTax(),
                    $taxNumber,
                    $order->getCouponeDiscount(),
                    $order->getTypeDiscount()
                )
            );

            $errors = $this->validator->validate($cart);

            if (count($errors) > 0) {
                throw new \Exception($errors[0]->getMessage());
            }

            $em->persist($cart);
            $em->flush();

            $em->getConnection()->commit();

            return $this->responseOk(
                [
                    'message' => 'Order was created',
                    'id' => $OrderId,
                    'hash' => $uuid
                ]);

        } catch (\Exception $e) {

            $this->doctrine->getConnection()->rollBack();

            $data = [
                'errors' => $e ? $e->getMessage() : "Data no valid"
            ];

            return $this->responseErr($data);

        }

    }

    public function payOrder(): JsonResponse
    {
        //запрос на оплату заказа

        $this->doctrine->getConnection()->beginTransaction();

        try {

            $data = $this->transformJsonBody(new Request());

            if (!$data || !$data->request->get('idOrder') || !$data->request->get('hash')) {
                throw new \Exception();
            }

            $idOrder = $data->request->get('idOrder');
            $hash = $data->request->get('hash');

            $em = $this->doctrine->getRepository(Order::class);
            $order = $em->find($idOrder);

            if (!$order) {
                throw new \Exception('Order not found');
            } elseif ($order->getHash() != $hash) {
                throw new \Exception('Order not confirmed');
            }

            $amount = $em->findAmountByOrder($idOrder);

            if (!$amount) {
                throw new \Exception('Error on order amount');
            }

            //начало оплаты
            $payProcessor = new Payment($order->getPaymentProcessor(), new PayData($amount[0]['amount'], $order));

            $payResult = $payProcessor->payment();

            if (!$payResult['result']) {
                throw new \Exception('payment error: ' . $payResult['errors']);
            }

            //обновление заказа
            //заказ оплачен
            $order->setIsPay(1); // помечаем заказ как оплаченный
            $order->setDatePay(new \DateTime('now'));

            $errors = $this->validator->validate($order);

            if (count($errors) > 0) {
                throw new \Exception($errors[0]->getMessage());
            }

            $em = $this->doctrine->getManager();

            $em->persist($order);
            $em->flush();

            $em->getConnection()->commit();

            return $this->responseOk(
                [
                    'message' => 'Order paid successfully',
                    'id' => $idOrder,
                    'date' => $order->getDatePay()
                ]);

        } catch (\Exception $e) {

            $this->doctrine->getConnection()->rollBack();

            return new JsonResponse([
                'errors' => $e ? $e->getMessage() : "Data no valid"
            ], 400);;

        }


    }

    private function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

    private function responseOk(array $res): JsonResponse
    {
        return new JsonResponse($res, 200);
    }

    private function responseErr(array $res): JsonResponse
    {
        return new JsonResponse($res, 400);
    }

}