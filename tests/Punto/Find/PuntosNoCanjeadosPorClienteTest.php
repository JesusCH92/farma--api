<?php

namespace App\Tests\Punto\Find;

use App\Cliente\Domain\Exception\NotFoundCliente;
use App\Punto\ApplicationService\Find\PuntosNoCanjeadosPorCliente;
use App\Tests\Punto\DummyClienteRepository;
use App\Tests\Punto\DummyPuntoRepository;
use App\Tests\Punto\StubClienteRepository;
use PHPUnit\Framework\TestCase;

class PuntosNoCanjeadosPorClienteTest extends TestCase
{
    /**
     * @test
     * @dataProvider clienteIdsRequest
     */
    public function notFoundClienteSiNoEncontramosCliente(int $clienteId)
    {
        $this->expectException(NotFoundCliente::class);

        $puntosNoCanjeadosPorClienteService = new PuntosNoCanjeadosPorCliente(
            new StubClienteRepository(),
            new DummyPuntoRepository()
        );

        $puntosNoCanjeadosPorClienteService($clienteId);
    }

    /**
     * @test
     * @dataProvider clienteIdsRequest
     */
    public function deberiaEncontrarPuntosNoCanjeadosPorCliente(int $clienteId)
    {
        $spyPuntoRepository = new SpyPuntoRepository();

        $puntosNoCanjeadosPorClienteService = new PuntosNoCanjeadosPorCliente(
            new DummyClienteRepository(),
            $spyPuntoRepository
        );

        $puntosNoCanjeadosPorClienteService($clienteId);

        $this->assertTrue($spyPuntoRepository->verify());
    }

    public function clienteIdsRequest(): array
    {
        return [
            [42],
            [15],
            [78],
            [29],
            [55],
            [67],
            [91],
            [3],
            [48],
            [72],
            [5],
            [37],
            [19],
            [62],
            [87],
            [10],
            [33],
            [25],
            [56],
            [81],
            [14],
            [70],
            [44],
            [23],
            [69],
            [53],
            [36],
            [8],
            [61],
            [99],
        ];
    }
}