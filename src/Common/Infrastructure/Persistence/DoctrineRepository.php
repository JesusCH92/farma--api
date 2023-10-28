<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function repository(string $entityName): ObjectRepository
    {
        return $this->entityManager()->getRepository($entityName);
    }

    protected function ormQueryBuilder(): QueryBuilder
    {
        return $this->entityManager()->createQueryBuilder();
    }
}
