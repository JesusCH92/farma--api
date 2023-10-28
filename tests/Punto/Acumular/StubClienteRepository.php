<?php

namespace App\Tests\Punto\Acumular;

use App\Cliente\Domain\Entity\Cliente;
use App\Cliente\Domain\Repository\ClienteRepository;

class StubClienteRepository implements ClienteRepository
{

    public function findById(int $farmaciaId): ?Cliente
    {
        return null;
    }
}