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
use OpenApi\Annotations as OA;

#[Route('/api')]
final class AcumuladorPuntoController extends SymfonyApiController
{
    public function __construct(private readonly Acumular $acumular)
    {
    }

    #[Route('/acumulador-punto', name: 'app_acumulador_punto', methods: 'POST')]
    /**
     * @OA\Response(
     *     response=Response::HTTP_CREATED,
     *     description="Los puntos se acumularon con éxito."
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
     *       name="puntos",
     *       in="header",
     *       description="cantidad de puntos a acumular",
     *       @OA\Schema(type="int")
     *   )
     * @OA\Tag(name="Acumulador de puntos")
     */
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
