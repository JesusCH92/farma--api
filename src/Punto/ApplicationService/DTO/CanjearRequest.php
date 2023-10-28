<?php

declare(strict_types=1);

namespace App\Punto\ApplicationService\DTO;

final readonly class CanjearRequest
{
    public array $puntoIds;

    public function __construct(public int $farmaciaId, public int $clienteId, int ...$puntoIds)
    {
        $this->puntoIds = $puntoIds;
    }
}
