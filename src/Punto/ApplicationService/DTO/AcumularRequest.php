<?php

declare(strict_types=1);

namespace App\Punto\ApplicationService\DTO;

final readonly class AcumularRequest
{
    public function __construct(public int $farmaciaId, public int $clienteId, public int $puntos)
    {
    }
}
