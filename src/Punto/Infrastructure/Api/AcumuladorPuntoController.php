<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Acumular;
use App\Punto\ApplicationService\DTO\AcumularRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
final class AcumuladorPuntoController extends SymfonyApiController
{
    public function __construct(private readonly Acumular $acumular)
    {
    }

    #[Route('/acumulador-punto', name: 'app_acumulador_punto', methods: 'POST')]
    public function acumuladorDePuntos(Request $request): JsonResponse
    {
        ($this->acumular)(
            new AcumularRequest(
                $request->request->getInt('farmacia_id'),
                $request->request->getInt('cliente_id'),
                $request->request->getInt('puntos')
            )
        );

        return $this->response([], Response::HTTP_CREATED);
    }
}
