<?php

declare(strict_types=1);

namespace App\Cliente\Domain\Repository;

use App\Cliente\Domain\Entity\Cliente;

interface ClienteRepository
{
    public function findById(int $farmaciaId): ?Cliente;
}
