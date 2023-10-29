<?php

namespace App\Tests\Punto\Canjear;

use App\Cliente\Domain\Exception\NotFoundCliente;
use App\Farmacia\Domain\Exception\NotFoundFarmacia;
use App\Punto\ApplicationService\Canjear;
use App\Punto\ApplicationService\DTO\CanjearRequest;
use App\Punto\Domain\Exception\NotFoundPunto;
use App\Tests\Punto\DummyClienteRepository;
use App\Tests\Punto\DummyFarmaciaRepository;
use App\Tests\Punto\DummyPuntoRepository;
use App\Tests\Punto\StubClienteRepository;
use App\Tests\Punto\StubFarmaciaRepository;
use PHPUnit\Framework\TestCase;

class CanjearTest extends TestCase
{
    /**
     * @test
     * @dataProvider canjearResquest
     */
    public function lanzamosNotFoundFarmaciaSiNoEncontramosFarmacia(int $farmaciaId, int $clienteId, array $puntoIds)
    {
        $this->expectException(NotFoundFarmacia::class);

        $canjearService = new Canjear(
            new StubFarmaciaRepository(),
            new DummyClienteRepository(),
            new DummyPuntoRepository()
        );

        $canjearService(new CanjearRequest($farmaciaId, $clienteId, ...$puntoIds));
    }

    /**
     * @test
     * @dataProvider canjearResquest
     */
    public function lanzamosNotFoundClienteSiNoEncontramosCliente(int $farmaciaId, int $clienteId, array $puntoIds)
    {
        $this->expectException(NotFoundCliente::class);

        $canjearService = new Canjear(
            new DummyFarmaciaRepository(),
            new StubClienteRepository(),
            new DummyPuntoRepository()
        );

        $canjearService(new CanjearRequest($farmaciaId, $clienteId, ...$puntoIds));
    }

    /**
     * @test
     * @dataProvider canjearResquest
     */
    public function lanzamosNotFoundPuntoSiNoEncontramosPunto(int $farmaciaId, int $clienteId, array $puntoIds)
    {
        $this->expectException(NotFoundPunto::class);

        $canjearService = new Canjear(
            new DummyFarmaciaRepository(),
            new DummyClienteRepository(),
            new StubPuntoRepository()
        );

        $canjearService(new CanjearRequest($farmaciaId, $clienteId, ...$puntoIds));
    }

    /**
     * @test
     * @dataProvider canjearResquest
     */
    public function deberiaCanjearPuntos(int $farmaciaId, int $clienteId, array $puntoIds)
    {
        $spyPuntoRepository = new SpyPuntoRepository();

        $canjearService = new Canjear(
            new DummyFarmaciaRepository(),
            new DummyClienteRepository(),
            $spyPuntoRepository
        );

        $canjearService(new CanjearRequest($farmaciaId, $clienteId, ...$puntoIds));

        $this->assertTrue($spyPuntoRepository->verify());
    }

    public function canjearResquest(): array
    {
        return [
            [1, 2, [2, 3, 4, 3]],
            [5, 6, [1, 2, 3, 4]],
            [7, 8, [5, 6, 7, 8]],
            [9, 10, [2, 4, 6, 8]],
            [11, 12, [3, 6, 9, 12]],
            [13, 14, [4, 3, 2, 1]],
            [15, 16, [5, 5, 5, 5]],
            [17, 18, [1, 1, 1, 1]],
            [19, 20, [9, 8, 7, 6]],
            [21, 22, [4, 4, 4, 4]],
            [23, 24, [6, 7, 8, 9]],
            [25, 26, [5, 4, 3, 2]],
            [27, 28, [7, 3, 8, 2]],
            [29, 30, [1, 1, 2, 2]],
            [3, 6, [7, 8, 9, 10]],
            [4, 5, [3, 2, 6, 4]],
            [12, 24, [3, 6, 9, 12]],
            [10, 20, [7, 8, 9, 5]],
            [14, 28, [3, 6, 8, 4]],
            [15, 30, [2, 4, 6, 8]],
            [8, 16, [5, 5, 5, 5]],
            [2, 4, [1, 1, 2, 2]],
            [18, 36, [9, 8, 7, 6]],
            [7, 14, [4, 4, 4, 4]],
            [26, 52, [6, 7, 8, 9]],
            [21, 42, [5, 4, 3, 2]],
            [34, 68, [7, 3, 8, 2]],
            [9, 18, [1, 1, 2, 2]],
            [11, 22, [7, 8, 9, 10]],
            [13, 26, [3, 2, 6, 4]]
        ];
    }
}