<?php

namespace App\Entity;

use App\Repository\DepositsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepositsRepository::class)]
class Deposits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $id_product = null;

    #[ORM\Column(nullable: true)]
    private ?int $val = null;

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

    public function getVal(): ?int
    {
        return $this->val;
    }

    public function setVal(?int $val): self
    {
        $this->val = $val;

        return $this;
    }
}
