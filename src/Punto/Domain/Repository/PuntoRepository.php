<?php

declare(strict_types=1);

namespace App\Punto\Domain\Repository;

use App\Cliente\Domain\Entity\Cliente;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;

interface PuntoRepository
{
    public function findByIdByClienteSinCajear(Cliente $cliente, int $puntoId): ?Punto;

    public function save(Punto $punto): void;

    public function canjearPuntos(Farmacia $farmacia, Punto ...$puntos): void;

    public function findAllPuntosSinCanjearByCliente(Cliente $cliente): Puntos;
}
