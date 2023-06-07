<?php

namespace App\Entity;

use App\Repository\CouponsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CouponsRepository::class)]
class Coupons
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $typecoupon = null;

    #[ORM\Column(nullable: true)]
    private ?int $val = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descr = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getTypecoupon(): ?int
    {
        return $this->typecoupon;
    }

    public function setTypecoupon(int $typecoupon): self
    {
        $this->typecoupon = $typecoupon;

        return $this;
    }

    public function getVal(): ?int
    {
        return $this->val;
    }

    public function setVal(?int $val): self
    {
        $this->val = $val;

        return $this;
    }

    public function getDescr(): ?string
    {
        return $this->descr;
    }

    public function setDescr(?string $descr): self
    {
        $this->descr = $descr;

        return $this;
    }
}
