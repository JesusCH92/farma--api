<?php

namespace App\Tests\Punto\Acumular;

use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\Domain\Entity\Puntos;

class StubFarmaciaRepository implements FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia
    {
        return null;
    }

    public function puntosNoCanjeadosEnUnPeriodo(ContadorPuntoNoCanjeadoRequest $dto): Puntos
    {
        return new Puntos([]);
    }
}