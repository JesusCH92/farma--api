<?php

declare(strict_types=1);

namespace App\Farmacia\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Farmacia\ApplicationService\ContadorPuntoNoCanjeado;
use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;

#[Route('/api')]
final class ContadorPuntoNoCanjeadoController extends SymfonyApiController
{
    public function __construct(private readonly ContadorPuntoNoCanjeado $contadorPuntoNoCanjeado)
    {
    }

    #[Route('/puntos-sin-canjear', name: 'app_contador_punto_no_canjeado', methods: 'GET')]
    /**
     * @OA\Get(
     *      path="/api/puntos-sin-canjear",
     *      summary="Obtiene el contador de puntos no canjeados en una farmacia en un rango de fechas.",
     *      @OA\Parameter(
     *          name="farmacia_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          example=1,
     *          description="ID de la farmacia."
     *      ),
     *      @OA\Parameter(
     *          name="fecha_inicio",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string", format="date"),
     *          example="2023-04-01",
     *          description="Fecha de inicio en el formato 'YYYY-MM-DD'."
     *      ),
     *      @OA\Parameter(
     *          name="fecha_fin",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string", format="date"),
     *          example="2023-12-31",
     *          description="Fecha de fin en el formato 'YYYY-MM-DD'."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa.",
     *          @OA\JsonContent(
     *              @OA\Property(property="cantidad_puntos_acumulados", type="integer", example=50)
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Parámetros incorrectos.",
     *          @OA\JsonContent()
     *      )
     *  )
     * @OA\Tag(name="Puntos otorgados y sin canjear en una farmacia durante un periodo")
     */
    public function contadorDePuntosNoCanjeadosEnFarmacia(Request $request): JsonResponse
    {
        $response = ($this->contadorPuntoNoCanjeado)(
            new ContadorPuntoNoCanjeadoRequest(
                $request->query->getInt('farmacia_id'),
                $this->convertDateOrFail($request->query->get('fecha_inicio')),
                $this->convertDateOrFail($request->query->get('fecha_fin')),
                null
            )
        );

        return $this->response(['cantidad_puntos_acumulados' => $response->cantidadTotal()]);
    }

    #[Route('/client-puntos-sin-canjear', name: 'app_contador_punto_no_canjeado_por_cliente', methods: 'GET')]
    /**
     * @OA\Get(
     *      path="/api/client-puntos-sin-canjear",
     *      summary="Obtiene el contador de puntos no canjeados en una farmacia para un cliente en un rango de fechas.",
     *      @OA\Parameter(
     *          name="farmacia_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          example=1,
     *          description="ID de la farmacia."
     *      ),
     *      @OA\Parameter(
     *          name="fecha_inicio",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string", format="date"),
     *          example="2023-06-01",
     *          description="Fecha de inicio en el formato 'YYYY-MM-DD'."
     *      ),
     *      @OA\Parameter(
     *          name="fecha_fin",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="string", format="date"),
     *          example="2023-12-31",
     *          description="Fecha de fin en el formato 'YYYY-MM-DD'."
     *      ),
     *      @OA\Parameter(
     *          name="cliente_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(type="integer"),
     *          example=2,
     *          description="ID del cliente."
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Operación exitosa.",
     *          @OA\JsonContent(
     *              @OA\Property(property="cantidad_puntos_acumulados", type="integer", example=50)
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Parámetros incorrectos.",
     *          @OA\JsonContent()
     *      ),
     *  )
     * @OA\Tag(name="Puntos otorgados y sin canjear en una farmacia durante un periodo a un cliente")
     */
    public function contadorDePuntosNoCanjeadosEnFarmaciaPorCliente(Request $request): JsonResponse
    {
        $response = ($this->contadorPuntoNoCanjeado)(
            new ContadorPuntoNoCanjeadoRequest(
                $request->query->getInt('farmacia_id'),
                $this->convertDateOrFail($request->query->get('fecha_inicio')),
                $this->convertDateOrFail($request->query->get('fecha_fin')),
                $request->query->getInt('cliente_id')
            )
        );

        return $this->response(['cantidad_puntos_acumulados' => $response->cantidadTotal()]);
    }
}
