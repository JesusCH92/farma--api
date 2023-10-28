<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Tarjeta $tarjeta;

    public function __construct(Tarjeta $tarjeta)
    {
        $this->tarjeta = $tarjeta;
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function tarjeta(): Tarjeta
    {
        return $this->tarjeta;
    }
}
