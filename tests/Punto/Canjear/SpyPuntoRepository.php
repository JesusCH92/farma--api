<?php

namespace App\Tests\Punto\Canjear;

use App\Cliente\Domain\Entity\Cliente;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;
use App\Punto\Domain\Repository\PuntoRepository;
use App\Tarjeta\Domain\Entity\Tarjeta;
use App\Tests\Common\Spy;

class SpyPuntoRepository extends Spy implements PuntoRepository
{
    public function findByIdByClienteSinCajear(Cliente $cliente, int $puntoId): ?Punto
    {
        return new Punto(new Cliente(new Tarjeta(100.00)), new Farmacia('a'), 100);
    }

    public function save(Punto $punto): void
    {
    }

    public function canjearPuntos(Farmacia $farmacia, Punto ...$puntos): void
    {
        $this->validateWasCalled = true;
    }

    public function findAllPuntosSinCanjearByCliente(Cliente $cliente): Puntos
    {
        return new Puntos([]);
    }
}