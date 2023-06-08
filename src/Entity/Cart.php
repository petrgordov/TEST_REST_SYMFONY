<?php

namespace App\Entity;

use App\Validator as Assert;
use App\Repository\CartRepository;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert_;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: CartRepository::class)]
class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_product = null;

    #[ORM\Column(nullable: true)]
    private ?float $price = null;

    #[ORM\Column(nullable: true)]
    private ?int $quantity = null;

    #[Assert\ConstraintTaxNumber(mode: 'loose')]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $taxnumber = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $couponCode = null;

    #[ORM\Column]
    private ?int $id_order = null;

    #[ORM\Column(nullable: true)]
    private ?float $price_base = null;

    #[ORM\Column(nullable: true)]
    private ?float $price_tax = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdProduct(): ?int
    {
        return $this->id_product;
    }

    public function setIdProduct(int $id_product): self
    {
        $this->id_product = $id_product;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): self
    {
        $this->price = $price;

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

    public function getTaxnumber(): ?string
    {
        return $this->taxnumber;
    }

    public function setTaxnumber(?string $taxnumber): self
    {
        $this->taxnumber = $taxnumber;

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

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
//        $metadata->addPropertyConstraint('id_product', new NotNull());
//        $metadata->addPropertyConstraint('quantity', new IntegerType());
//        $metadata->addPropertyConstraint('price', new FloatType());
    }

    public function getIdOrder(): ?int
    {
        return $this->id_order;
    }

    public function setIdOrder(int $id_order): self
    {
        $this->id_order = $id_order;

        return $this;
    }

    public function getPriceBase(): ?float
    {
        return $this->price_base;
    }

    public function setPriceBase(?float $price_base): self
    {
        $this->price_base = $price_base;

        return $this;
    }

    public function getPriceTax(): ?float
    {
        return $this->price_tax;
    }

    public function setPriceTax(?float $price_tax): self
    {
        $this->price_tax = $price_tax;

        return $this;
    }
}
