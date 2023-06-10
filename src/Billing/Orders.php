<?php

namespace App\Billing;

use App\Validator as MyAssert;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class Orders
{
    #[Assert\NotBlank(message:'Field product is not empty')]
    private ?int $product = null;

    #[MyAssert\ConstraintTaxNumber(mode: 'loose')]
    private ?string $taxNumber = null;

    private ?string $couponCode = null;

    #[Assert\NotBlank(message:'Field paymentProcessor is not empty')]
    #[MyAssert\PaypalPaymentProcessor(mode: 'loose')]
    private ?string $paymentProcessor = null;

    #[Assert\NotBlank(message:'Field quantity is not empty')]
    private ?int $quantity = null;


    public function getProduct(): ?int
    {
        return $this->product;
    }

    public function setProduct(?int $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTaxNumber(): ?string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(?string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;
        return $this;
    }

    public function getCouponCode(): ?string
    {
        return $this->couponCode;
    }

    public function setCouponCode(?string $couponCode): self
    {
        $this->couponCode = $couponCode;
        return $this;
    }

    public function getPaymentProcessor(): ?string
    {
        return $this->paymentProcessor;
    }

    public function setPaymentProcessor(?string $paymentProcessor): self
    {
        $this->paymentProcessor = $paymentProcessor;
        return $this;
    }
//
//    public static function loadValidatorMetadata(ClassMetadata $metadata): void
//    {
//        $metadata->addPropertyConstraint('product', new NotBlank());
//        $metadata->addPropertyConstraint('paymentProcessor', new NotBlank());
//        $metadata->addPropertyConstraint('quantity', new NotBlank());
//
//    }
}