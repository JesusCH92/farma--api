<?php

declare(strict_types=1);

namespace App\Punto\Domain\Entity;

use App\Common\Domain\Collection;

final class Puntos extends Collection
{
    protected function type(): string
    {
        return Punto::class;
    }
}
