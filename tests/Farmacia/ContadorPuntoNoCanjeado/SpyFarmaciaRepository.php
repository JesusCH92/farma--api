<?php

namespace App\Tests\Farmacia\ContadorPuntoNoCanjeado;

use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\Domain\Entity\Puntos;
use App\Tests\Common\Spy;

class SpyFarmaciaRepository extends Spy implements FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia
    {
        return null;
    }

    public function puntosNoCanjeadosEnUnPeriodo(ContadorPuntoNoCanjeadoRequest $dto): Puntos
    {
        $this->validateWasCalled = true;

        return new Puntos([]);
    }
}