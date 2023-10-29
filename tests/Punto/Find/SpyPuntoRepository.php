<?php

namespace App\Tests\Punto\Find;

use App\Cliente\Domain\Entity\Cliente;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;
use App\Punto\Domain\Repository\PuntoRepository;

class SpyPuntoRepository implements PuntoRepository
{
    private bool $validateWasCalled = false;

    public function findByIdByClienteSinCajear(Cliente $cliente, int $puntoId): ?Punto
    {
        return null;
    }

    public function save(Punto $punto): void
    {
    }

    public function canjearPuntos(Farmacia $farmacia, Punto ...$puntos): void
    {
    }

    public function findAllPuntosSinCanjearByCliente(Cliente $cliente): Puntos
    {
        $this->validateWasCalled = true;

        return new Puntos([]);
    }

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}