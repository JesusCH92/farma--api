<?php

namespace App\Tests\Punto\Acumular;

use App\Cliente\Domain\Entity\Cliente;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;
use App\Punto\Domain\Repository\PuntoRepository;
use App\Tests\Common\Spy;

class SpyPuntoRepository extends Spy implements PuntoRepository
{
    public function findByIdByClienteSinCajear(Cliente $cliente, int $puntoId): ?Punto
    {
        return null;
    }

    public function save(Punto $punto): void
    {
        $this->validateWasCalled = true;
    }

    public function canjearPuntos(Farmacia $farmacia, Punto ...$puntos): void
    {
    }

    public function findAllPuntosSinCanjearByCliente(Cliente $cliente): Puntos
    {
        return new Puntos([]);
    }
}