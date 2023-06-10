<?php

namespace App\PaymentProcessor;


interface PaymentProcessorInterface
{
    public function pay(int|float $price): void;

    public function getResult(): bool;
}