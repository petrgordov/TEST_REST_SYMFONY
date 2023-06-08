<?php

namespace App\PaymentProcessor;

class Payment
{
    private PaymentProcessorInterface $pProcessor;

    public function __construct(string $paymentProcessor, private PayData $payData)
    {
        // подключаем нужный процессор оплаты
        $this->pProcessor = match ($paymentProcessor) {
            'paypal' => new PaypalPaymentProcessor(),
            default => fn() => throw new Exception('Pay processor not exists')
        };
    }

    public function payment(): array
    {
        //инициируем оплату

        try {

            //
            $this->pProcessor->pay($this->payData->amount);

            //Ошибка на стороне платёжного шлюза
            if (!$this->pProcessor->getResult()) {
                throw new Exception('Error on the side of the payment gateway');
            }

            return ['result' => true, 'message' => 'payment accepted'];

        } catch (\Exception $e) {

            return [
                'result' => false,
                'errors' => $e ? $e->getMessage() : "Data no valid"
            ];

        }

    }

    public function check()
    {
        //логика для проверки платежа
    }


}