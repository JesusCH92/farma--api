<?php

declare(strict_types=1);

namespace App\Farmacia\ApplicationService;

use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\Domain\Entity\Puntos;

final class ContadorPuntoNoCanjeado
{
    public function __construct(private readonly FarmaciaRepository $repository)
    {
    }

    public function __invoke(ContadorPuntoNoCanjeadoRequest $request): Puntos
    {
        return $this->repository->puntosNoCanjeadosEnUnPeriodo($request);
    }
}
