<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Canjear;
use App\Punto\ApplicationService\DTO\CanjearRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/api')]
final class CanjeadorPuntoController extends SymfonyApiController
{
    public function __construct(private readonly Canjear $canjear)
    {
    }

    #[Route('/canjeador-punto', name: 'app_canjeador_punto', methods: 'POST')]
    /**
     * @OA\Response(
     *     response=Response::HTTP_OK,
     *     description="Canjeador de puntos"
     * )
     * @OA\Parameter(
     *     name="farmacia_id",
     *     in="header",
     *     description="ID de la farmacia",
     *     @OA\Schema(type="int")
     * )
     * @OA\Parameter(
     *      name="cliente_id",
     *      in="header",
     *      description="ID del cliente",
     *      @OA\Schema(type="int")
     *  )
     * @OA\Parameter(
     *       name="punto_collection",
     *       in="header",
     *       description="la colección de puntos debe venir en la siguiente forma: '1,2,3,4'",
     *       @OA\Schema(type="string")
     *   )
     * @OA\Tag(name="Canjeador de puntos")
     */
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
