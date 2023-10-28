<?php

declare(strict_types=1);

namespace App\Cliente\Infrastructure\Persistence;

use App\Cliente\Domain\Entity\Cliente;
use App\Cliente\Domain\Repository\ClienteRepository;
use App\Common\Infrastructure\Persistence\DoctrineRepository;

final class DoctrineClienteRepository extends DoctrineRepository implements ClienteRepository
{
    public function findById(int $clienteId): ?Cliente
    {
        return $this->repository(Cliente::class)->findOneBy(['id' => $clienteId]);
    }
}
