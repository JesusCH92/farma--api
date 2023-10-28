<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Tarjeta
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id;
    #[ORM\Column(name: 'saldo', type: Types::DECIMAL, precision: 5, scale: 2, nullable: false)]
    private float $saldo;

    public function __construct(float $saldo)
    {
        $this->saldo = $saldo;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function saldo(): float
    {
        return $this->saldo;
    }
}
