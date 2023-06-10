<?php

namespace App\PaymentProcessor;

class PaypalPaymentProcessor implements PaymentProcessorInterface
{
    private bool $result = false;
    private string $error = '';

    /**
     * @throws Exception in case of a failed payment
     */
    public function pay(int|float $price): void
    {
        try {
            if ($price > 100) {
                throw new \Exception('Too high price');
            }
            //process payment logic
            $this->result = true;
        }catch (\Exception $e){
            $this->result = false;
            $this->error = $e->getMessage();
        }

    }

    public function getResult(): bool
    {
        return $this->result;
    }
    public function getError(): string
    {
        return $this->error;
    }

}