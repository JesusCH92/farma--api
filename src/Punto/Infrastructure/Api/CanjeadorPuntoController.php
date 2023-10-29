<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Canjear;
use App\Punto\ApplicationService\DTO\CanjearRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
final class CanjeadorPuntoController extends SymfonyApiController
{
    public function __construct(private readonly Canjear $canjear)
    {
    }

    #[Route('/canjeador-punto', name: 'app_canjeador_punto', methods: 'POST')]
    public function canjeadorDePuntos(Request $request): JsonResponse
    {
        $puntoIds = array_map(fn($id) => (int)$id, explode(',', $request->request->get('punto_collection')));

        ($this->canjear)(
            new CanjearRequest(
                $request->request->getInt('farmacia_id'),
                $request->request->getInt('cliente_id'),
                ...$puntoIds
            )
        );

        return $this->response([]);
    }
}
