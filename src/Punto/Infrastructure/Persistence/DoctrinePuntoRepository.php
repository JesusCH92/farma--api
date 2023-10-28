<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Persistence;

use App\Cliente\Domain\Entity\Cliente;
use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;
use App\Punto\Domain\Repository\PuntoRepository;

final class DoctrinePuntoRepository extends DoctrineRepository implements PuntoRepository
{
    public function findByIdByClienteSinCajear(Cliente $cliente, int $puntoId): ?Punto
    {
        return $this->repository(Punto::class)->findOneBy(['id' => $puntoId, 'cliente' => $cliente]);
    }

    public function save(Punto $punto): void
    {
        $this->entityManager()->persist($punto);
        $this->entityManager()->flush();
    }

    public function canjearPuntos(Farmacia $farmacia, Punto ...$puntos): void
    {
        foreach ($puntos as $punto) {
            if (!$punto->esCanjeable()) {
                continue;
            }

            $punto->canjeando($farmacia);

            $this->save($punto);
        }
    }

    public function findAllPuntosSinCanjearByCliente(Cliente $cliente): Puntos
    {
        $collection = $this->repository(Punto::class)->findBy(['cliente' => $cliente, 'farmaciaCanjeada' => null]);

        return new Puntos($collection);
    }
}
