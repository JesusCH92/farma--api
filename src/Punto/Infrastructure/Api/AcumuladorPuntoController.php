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
     * @OA\Post(
     *     path="/api/acumulador-punto",
     *     summary="Acumula puntos para un cliente en una farmacia.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="farmacia_id",
     *                     type="integer",
     *                     example="1"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer",
     *                     example="1"
     *                 ),
     *                 @OA\Property(
     *                     property="puntos",
     *                     type="integer",
     *                     example="50"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Operación exitosa.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Parámetros incorrectos.",
     *         @OA\JsonContent()
     *     )
     * ),
     * @OA\Tag(name="Acumulador de Puntos")
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
