<?php

declare(strict_types=1);

namespace App\Punto\ApplicationService;

use App\Cliente\Domain\Entity\Cliente;
use App\Cliente\Domain\Repository\ClienteRepository;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\ApplicationService\DTO\AcumularRequest;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Repository\PuntoRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class Acumular
{
    public function __construct(
        private readonly FarmaciaRepository $farmaciaRepository,
        private readonly ClienteRepository $clienteRepository,
        private readonly PuntoRepository $repository
    ) {
    }

    public function __invoke(AcumularRequest $request): void
    {
        $farmacia = $this->findFarmaciaOrFail($request->farmaciaId);
        $cliente  = $this->findClienteOrFail($request->clienteId);

        $punto = new Punto($cliente, $farmacia, $request->puntos);

        $this->repository->save($punto);
    }

    private function findFarmaciaOrFail(int $farmaciaId): Farmacia
    {
        $farmacia = $this->farmaciaRepository->findById($farmaciaId);

        if (null === $farmacia) {
            throw new NotFoundHttpException(sprintf('La farmacia con id: %s, no existe', $farmaciaId));
        }

        return $farmacia;
    }

    private function findClienteOrFail(int $clienteId): Cliente
    {
        $cliente = $this->clienteRepository->findById($clienteId);

        if (null === $cliente) {
            throw new NotFoundHttpException(sprintf('El cliente con id: %s, no existe', $clienteId));
        }

        return $cliente;
    }
}
