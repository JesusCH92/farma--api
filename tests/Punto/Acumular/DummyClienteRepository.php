<?php

namespace App\Tests\Punto\Acumular;

use App\Cliente\Domain\Entity\Cliente;
use App\Cliente\Domain\Repository\ClienteRepository;
use App\Tarjeta\Domain\Entity\Tarjeta;

class DummyClienteRepository implements ClienteRepository
{
    public function findById(int $farmaciaId): ?Cliente
    {
        $tarjeta = new Tarjeta(100.00);
        return new Cliente($tarjeta);
    }
}