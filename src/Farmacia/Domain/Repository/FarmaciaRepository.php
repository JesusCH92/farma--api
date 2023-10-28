<?php

declare(strict_types=1);

namespace App\Farmacia\Domain\Repository;

use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Puntos;

interface FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia;

    public function puntosNoCanjeadosEnUnPeriodo(ContadorPuntoNoCanjeadoRequest $dto): Puntos;
}
