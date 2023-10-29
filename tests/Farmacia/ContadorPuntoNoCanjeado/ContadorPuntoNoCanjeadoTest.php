<?php

namespace App\Tests\Farmacia\ContadorPuntoNoCanjeado;

use App\Farmacia\ApplicationService\ContadorPuntoNoCanjeado;
use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class ContadorPuntoNoCanjeadoTest extends TestCase
{
    /**
     * @test
     * @dataProvider criterioRequest
     */
    public function deberiaEncontrarPuntosNoCanjeados(
        int $farmciaId,
        DateTimeImmutable $fechaInicio,
        DateTimeImmutable $fechaFin,
        ?int $clienteId
    ) {
        $spyFarmaciaRepository = new SpyFarmaciaRepository();

        $contadorPuntoNoCanjeadoService = new ContadorPuntoNoCanjeado($spyFarmaciaRepository);

        $contadorPuntoNoCanjeadoService(
            new ContadorPuntoNoCanjeadoRequest(
                $farmciaId,
                $fechaInicio,
                $fechaFin,
                $clienteId
            )
        );

        $this->assertTrue($spyFarmaciaRepository->verify());
    }

    public function criterioRequest(): array
    {
        return [
            [5, new DateTimeImmutable('2023-01-15'), new DateTimeImmutable('2023-01-25'), 3],
            [8, new DateTimeImmutable('2023-01-10'), new DateTimeImmutable('2023-01-20'), 6],
            [2, new DateTimeImmutable('2023-01-05'), new DateTimeImmutable('2023-01-15'), 7],
            [1, new DateTimeImmutable('2023-01-01'), new DateTimeImmutable('2023-01-31'), 4],
            [9, new DateTimeImmutable('2023-01-02'), new DateTimeImmutable('2023-01-30'), 2],
            [6, new DateTimeImmutable('2023-01-03'), new DateTimeImmutable('2023-01-29'), null],
            [4, new DateTimeImmutable('2023-01-12'), new DateTimeImmutable('2023-01-22'), 5],
            [7, new DateTimeImmutable('2023-01-07'), new DateTimeImmutable('2023-01-27'), 8],
            [3, new DateTimeImmutable('2023-01-09'), new DateTimeImmutable('2023-01-19'), 1],
            [10, new DateTimeImmutable('2023-01-11'), new DateTimeImmutable('2023-01-21'), 10],
            [5, new DateTimeImmutable('2023-01-16'), new DateTimeImmutable('2023-01-26'), 4],
            [8, new DateTimeImmutable('2023-01-13'), new DateTimeImmutable('2023-01-23'), 7],
            [2, new DateTimeImmutable('2023-01-06'), new DateTimeImmutable('2023-01-16'), null],
            [1, new DateTimeImmutable('2023-01-04'), new DateTimeImmutable('2023-01-24'), 3],
            [9, new DateTimeImmutable('2023-01-14'), new DateTimeImmutable('2023-01-18'), 2],
            [6, new DateTimeImmutable('2023-01-08'), new DateTimeImmutable('2023-01-28'), 8],
            [4, new DateTimeImmutable('2023-01-17'), new DateTimeImmutable('2023-01-25'), 5],
            [7, new DateTimeImmutable('2023-01-22'), new DateTimeImmutable('2023-01-23'), 1],
            [3, new DateTimeImmutable('2023-01-24'), new DateTimeImmutable('2023-01-27'), 10],
            [10, new DateTimeImmutable('2023-01-20'), new DateTimeImmutable('2023-01-30'), null],
            [5, new DateTimeImmutable('2023-01-03'), new DateTimeImmutable('2023-01-18'), 6],
            [8, new DateTimeImmutable('2023-01-08'), new DateTimeImmutable('2023-01-29'), 7],
            [2, new DateTimeImmutable('2023-01-10'), new DateTimeImmutable('2023-01-21'), 3],
            [1, new DateTimeImmutable('2023-01-12'), new DateTimeImmutable('2023-01-19'), 4],
            [9, new DateTimeImmutable('2023-01-05'), new DateTimeImmutable('2023-01-25'), 2],
            [6, new DateTimeImmutable('2023-01-02'), new DateTimeImmutable('2023-01-22'), 8],
            [4, new DateTimeImmutable('2023-01-15'), new DateTimeImmutable('2023-01-28'), 5],
            [7, new DateTimeImmutable('2023-01-07'), new DateTimeImmutable('2023-01-26'), 1],
            [3, new DateTimeImmutable('2023-01-11'), new DateTimeImmutable('2023-01-20'), 10],
            [10, new DateTimeImmutable('2023-01-09'), new DateTimeImmutable('2023-01-30'), 9],
        ];
    }
}