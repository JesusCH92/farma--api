<?php

declare(strict_types=1);

namespace App\Farmacia\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use App\Farmacia\Domain\Entity\Farmacia;
use App\Farmacia\Domain\Repository\FarmaciaRepository;
use App\Punto\Domain\Entity\Punto;
use App\Punto\Domain\Entity\Puntos;
use Doctrine\ORM\QueryBuilder;

final class DoctrineFarmaciaRepository extends DoctrineRepository implements FarmaciaRepository
{
    public function findById(int $farmaciaId): ?Farmacia
    {
        return $this->repository(Farmacia::class)->findOneBy(['id' => $farmaciaId]);
    }

    public function puntosNoCanjeadosEnUnPeriodo(ContadorPuntoNoCanjeadoRequest $dto): Puntos
    {
        $qb = $this
            ->ormQueryBuilder()
            ->select('p')
            ->from(Punto::class, 'p')
            ->join('p.farmacia', 'f')
            ->andWhere('p.farmaciaCanjeada IS NULL')
            ->andWhere('f.id = :farmaciaId')
            ->andWhere('p.creado > :fecha_inicio')
            ->andWhere('p.creado < :fecha_fin')
            ->setParameter('farmaciaId', $dto->farmaciaId)
            ->setParameter('fecha_inicio', $dto->fechaInicio)
            ->setParameter('fecha_fin', $dto->fechaFin);

        $qb = $this->addClienteFiltro($qb, $dto->clienteId);

        $collection = $qb->getQuery()->getResult();

        return new Puntos($collection);
    }

    private function addClienteFiltro(QueryBuilder $qb, ?int $clienteId): QueryBuilder
    {
        if (null === $clienteId) {
            return $qb;
        }

        $qb->andWhere('p.cliente = :clienteId')->setParameter('clienteId', $clienteId);

        return $qb;
    }
}
