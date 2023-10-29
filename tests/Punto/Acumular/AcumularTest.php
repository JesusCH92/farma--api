<?php

namespace App\Tests\Punto\Acumular;

use App\Cliente\Domain\Exception\NotFoundCliente;
use App\Farmacia\Domain\Exception\NotFoundFarmacia;
use App\Punto\ApplicationService\Acumular;
use App\Punto\ApplicationService\DTO\AcumularRequest;
use App\Tests\Punto\DummyClienteRepository;
use App\Tests\Punto\DummyFarmaciaRepository;
use App\Tests\Punto\DummyPuntoRepository;
use App\Tests\Punto\SpyPuntoRepository;
use App\Tests\Punto\StubClienteRepository;
use App\Tests\Punto\StubFarmaciaRepository;
use PHPUnit\Framework\TestCase;

class AcumularTest extends TestCase
{
    /**
     * @test
     * @dataProvider acumularResquest
     */
    public function lanzamosNotFoundFarmaciaSiNoEncontramosFarmacia(int $farmaciaId, int $clienteId, int $puntos)
    {
        $this->expectException(NotFoundFarmacia::class);

        $acumularService = new Acumular(
            new StubFarmaciaRepository(),
            new DummyClienteRepository(),
            new DummyPuntoRepository()
        );

        $acumularService(new AcumularRequest($farmaciaId, $clienteId, $puntos));
    }

    /**
     * @test
     * @dataProvider acumularResquest
     */
    public function lanzamosNotFoundClienteSiNoEncontramosCliente(int $farmaciaId, int $clienteId, int $puntos)
    {
        $this->expectException(NotFoundCliente::class);

        $acumularService = new Acumular(
            new DummyFarmaciaRepository(),
            new StubClienteRepository(),
            new DummyPuntoRepository()
        );

        $acumularService(new AcumularRequest($farmaciaId, $clienteId, $puntos));
    }

    /**
     * @test
     * @dataProvider acumularResquest
     */
    public function deberiaCrearPunto(int $farmaciaId, int $clienteId, int $puntos)
    {
        $spyPuntoRepository = new SpyPuntoRepository();

        $acumularService = new Acumular(
            new DummyFarmaciaRepository(),
            new DummyClienteRepository(),
            $spyPuntoRepository
        );

        $acumularService(new AcumularRequest($farmaciaId, $clienteId, $puntos));

        $this->assertTrue($spyPuntoRepository->verify());
    }

    public function acumularResquest(): array
    {
        return [
            [4, 7, 2],
            [1, 9, 3],
            [8, 5, 6],
            [2, 6, 8],
            [3, 1, 7],
            [5, 4, 2],
            [9, 8, 3],
            [6, 2, 5],
            [7, 3, 1],
            [2, 4, 9],
            [8, 6, 3],
            [1, 5, 7],
            [3, 2, 4],
            [9, 7, 8],
            [4, 1, 5],
            [5, 9, 6],
            [7, 8, 1],
            [2, 3, 6],
            [6, 4, 9],
            [3, 1, 2],
            [1, 8, 7],
            [5, 2, 4],
            [9, 6, 5],
            [8, 7, 3],
            [4, 2, 1],
            [7, 9, 4],
            [6, 3, 8],
            [3, 5, 1],
            [2, 8, 9],
            [1, 6, 7],
        ];
    }
}