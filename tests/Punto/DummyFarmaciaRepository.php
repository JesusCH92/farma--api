<?php

namespace App\Tests\Punto;

use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\Domain\Entity\Puntos;

class DummyFarmaciaRepository implements FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia
    {
        return new Farmacia('farma');
    }

    public function puntosNoCanjeadosEnUnPeriodo(ContadorPuntoNoCanjeadoRequest $dto): Puntos
    {
        return new Puntos([]);
    }
}