<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Validator as Assert;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?int $id_user = null;

    #[Assert\ConstraintPaymentProcessor(mode: 'loose')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $paymentProcessor = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 20)]
    private ?string $country = null;

    #[Assert\ConstraintTaxNumber(mode: 'loose')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $taxNumber = null;


    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_pay = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pay_info = null;

    #[ORM\Column(nullable: true)]
    private ?int $is_pay = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couponCode = null;

    #[ORM\Column(nullable: true)]
    private ?int $coupone_discount = null;

    #[ORM\Column(nullable: true)]
    private ?int $typeDiscount = null;

    #[ORM\Column(length: 255)]
    private ?string $hash = null;

    #[ORM\Column(nullable: true)]
    private ?int $tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }
    public function getIdUser(): ?int
    {
        return $this->id_user;
    }

    public function setIdUser(?int $id_user): self
    {
        $this->id_user = $id_user;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

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


    public function getDatePay(): ?\DateTimeInterface
    {
        return $this->date_pay;
    }

    public function setDatePay(?\DateTimeInterface $date_pay): self
    {
        $this->date_pay = $date_pay;

        return $this;
    }

    public function getPayInfo(): ?string
    {
        return $this->pay_info;
    }

    public function setPayInfo(?string $pay_info): self
    {
        $this->pay_info = $pay_info;

        return $this;
    }

    public function getIsPay(): ?int
    {
        return $this->is_pay;
    }

    public function setIsPay(?int $is_pay): self
    {
        $this->is_pay = $is_pay;

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

    public function getCouponeDiscount(): ?int
    {
        return $this->coupone_discount;
    }

    public function setCouponeDiscount(?int $coupone_discount): self
    {
        $this->coupone_discount = $coupone_discount;

        return $this;
    }

    public function getTypeDiscount(): ?int
    {
        return $this->typeDiscount;
    }

    public function setTypeDiscount(?int $typeDiscount): self
    {
        $this->typeDiscount = $typeDiscount;

        return $this;
    }

    public function getHash(): ?string
    {
        return $this->hash;
    }

    public function setHash(string $hash): self
    {
        $this->hash = $hash;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(?int $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
