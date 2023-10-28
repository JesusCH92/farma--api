<?php

declare(strict_types=1);

namespace App\Farmacia\Domain\Repository;

use App\Farmacia\Domain\Entity\Farmacia;

interface FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia;
}
