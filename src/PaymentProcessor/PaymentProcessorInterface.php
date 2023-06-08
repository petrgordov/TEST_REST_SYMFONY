<?php

namespace App\PaymentProcessor;


interface PaymentProcessorInterface
{
    public function pay(int $price): void;

    public function getResult(): bool;
}