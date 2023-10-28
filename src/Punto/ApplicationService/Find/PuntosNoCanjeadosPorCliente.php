<?php

declare(strict_types=1);

namespace App\Punto\ApplicationService\Find;

use App\Cliente\Domain\Entity\Cliente;
use App\Cliente\Domain\Exception\NotFoundCliente;
use App\Cliente\Domain\Repository\ClienteRepository;
use App\Punto\Domain\Entity\Puntos;
use App\Punto\Domain\Repository\PuntoRepository;

final class PuntosNoCanjeadosPorCliente
{
    public function __construct(
        private readonly ClienteRepository $clienteRepository,
        private readonly PuntoRepository $repository
    ) {
    }

    public function __invoke(int $clienteId): Puntos
    {
        $cliente = $this->findClienteOrFail($clienteId);

        return $this->repository->findAllPuntosSinCanjearByCliente($cliente);
    }

    private function findClienteOrFail(int $clienteId): Cliente
    {
        $cliente = $this->clienteRepository->findById($clienteId);

        if (null === $cliente) {
            throw new NotFoundCliente(sprintf('El cliente con id: %s, no existe', $clienteId));
        }

        return $cliente;
    }
}
