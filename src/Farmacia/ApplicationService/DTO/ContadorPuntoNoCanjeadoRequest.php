<?php

declare(strict_types=1);

namespace App\Farmacia\ApplicationService\DTO;

use DateTimeImmutable;

final readonly class ContadorPuntoNoCanjeadoRequest
{
    public function __construct(
        public int $farmaciaId,
        public DateTimeImmutable $fechaInicio,
        public DateTimeImmutable $fechaFin,
        public ?int $clienteId
    ) {
    }
}
