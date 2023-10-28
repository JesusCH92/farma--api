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
    public function cantidadTotal(): int
    {
        return $this->sumarCantidadPuntos(...$this->items());
    }

    public function sumarCantidadPuntos(Punto ...$puntos): int
    {
        return array_sum(array_map(fn(Punto $punto) => $punto->cantidad(), $puntos));
    }
}
