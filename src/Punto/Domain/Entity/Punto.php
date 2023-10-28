<?php

namespace App\Punto\Domain\Entity;

use App\Cliente\Domain\Entity\Cliente;
use App\Farmacia\Domain\Entity\Farmacia;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Punto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'cliente_id', nullable: false)]
    private Cliente $cliente;
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'farmacia_id', nullable: false)]
    private Farmacia $farmacia;
    #[ORM\Column(name: 'creado', type: Types::DATE_IMMUTABLE)]
    private DateTimeImmutable $creado;
    #[ORM\Column(name: 'cantidad', type: Types::INTEGER, nullable: false)]
    private int $cantidad;
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(name: 'farmacia_canjeada_id', nullable: true)]
    private ?Farmacia $farmaciaCanjeada;

    public function __construct(Cliente $cliente, Farmacia $farmacia, int $cantidad)
    {
        $this->cliente  = $cliente;
        $this->farmacia = $farmacia;
        $this->cantidad = $cantidad;
        $this->creado   = new DateTimeImmutable();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function cliente(): Cliente
    {
        return $this->cliente;
    }

    public function farmacia(): Farmacia
    {
        return $this->farmacia;
    }

    public function creado(): DateTimeImmutable
    {
        return $this->creado;
    }

    public function cantidad(): int
    {
        return $this->cantidad;
    }

    public function farmaciaCanjeada(): ?Farmacia
    {
        return $this->farmaciaCanjeada;
    }

    public function estaCanjeado(): bool
    {
        return $this->farmaciaCanjeada() !== null;
    }

    public function esCanjeable(): bool
    {
        return $this->cliente()->tarjeta()->saldo() > $this->cantidad() && !$this->estaCanjeado();
    }

    public function canjeando(Farmacia $farmacia): void
    {
        $this->farmaciaCanjeada = $farmacia;
    }
}
