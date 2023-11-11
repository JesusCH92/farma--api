<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Canjear;
use App\Punto\ApplicationService\DTO\CanjearRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @OA\Post(
     *     path="/api/canjeador-punto",
     *     summary="Canjea puntos para un cliente en una farmacia.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="farmacia_id",
     *                     type="integer",
     *                     example="2"
     *                 ),
     *                 @OA\Property(
     *                     property="cliente_id",
     *                     type="integer",
     *                     example="1"
     *                 ),
     *                 @OA\Property(
     *                     property="punto_collection",
     *                     type="string",
     *                     example="1,2,3"
     *                 ),
     *             ),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Operación exitosa.",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Parámetros incorrectos.",
     *         @OA\JsonContent()
     *     )
     * ),
     * @OA\Tag(name="Canjeador de Puntos")
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
