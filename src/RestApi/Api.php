<?php

namespace App\RestApi;

use App\Catalog\Pricing;
use App\Entity\Order;
use App\Entity\Products;
use App\Validator\ConstraintTaxNumber;
use App\Validator\ConstraintTaxNumberValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductsRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Api
{

    public function __construct(private ManagerRegistry $doctrine,private ValidatorInterface $validator) {}

    public function __call(string $name, array $arguments): JsonResponse
    {
        return new JsonResponse([
            'message' => 'Error call method: '.$name,
        ],400);
    }

    public function Product(int $id,string $taxNumber): JsonResponse
    {

        try{

            if($id==0){
                return new JsonResponse([
                    'message' => 'The product Not found',
                ],400);
            }
//            $em = new ProductsRepository($this->doctrine);

            $em = $this->doctrine->getRepository(Products::class);
            $product =$em->findInfoByProduct($id);

            if (!$product) {
                throw new \Exception();
            }

            Pricing::BasePrice($product[0]['price'],$taxNumber);

            return new JsonResponse($product[0],200);

        }catch (\Exception $e){

            $data = [
                'status' => 400,
                'errors' => 'Not found product for id ' . $id,
            ];

            return new JsonResponse($data, 400);
        }

    }

    public function Order(): JsonResponse
    {

        try {

            $request = new Request();

            $data = $this->transformJsonBody($request);

            if (!$data || !$data->request->get('product') || !$data->request->get('paymentProcessor')) {
                throw new \Exception();
            }

            //формирование заказа

            $order = new Order();
            $order->setTaxNumber($data->request->get('taxNumber'));

            $errors = $this->validator->validate($order);
////            $errors=null;
//            dump($errors );

            if (count($errors) > 0) {
                // ... this IS a valid
                $errorsString = (string) $errors;
//                $errors[0]->getMessage()
                return new JsonResponse($errors[0]->getMessage(),400);
            } else {
                // this is *not* a valid
                return new JsonResponse($data->request->all(), 200);


            }



        } catch (\Exception $e) {

            $data = [
                'status' => 400,
                'errors' => "Data no valid",
            ];

            return new JsonResponse($data, 400);

        }

    }

    public function transformJsonBody(Request $request): Request
    {
        $data = json_decode($request->getContent(), true);

        if ($data === null) {
            return $request;
        }

        $request->request->replace($data);

        return $request;
    }

    private function getTax(string $taxNumber): int
    {

//        Германии - 19%
//        Италии - 22%
//        Греции - 24%

        $country=substr($taxNumber,2);

        return match ($country) {
            'DE' => 19,
            'IT' => 22,
            'GR' => 24,
            'FR' => 20,
            default => 0
        };
    }

}