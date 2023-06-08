<?php

namespace App\PaymentProcessor;

class PaypalPaymentProcessor implements PaymentProcessorInterface
{
    private bool $result = false;

    /**
     * @throws Exception in case of a failed payment
     */
    public function pay(int $price): void
    {
        if ($price > 100) {
            throw new Exception('Too high price');
        }

        //process payment logic
        $this->result = true;
    }

    public function getResult(): bool
    {
        return $this->result;
    }

}