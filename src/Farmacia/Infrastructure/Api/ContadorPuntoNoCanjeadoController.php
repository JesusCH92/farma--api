<?php

declare(strict_types=1);

namespace App\Farmacia\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Farmacia\ApplicationService\ContadorPuntoNoCanjeado;
use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
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
     * @OA\Response(
     *     response=Response::HTTP_OK,
     *     description="Mostramos la cantidad(float) de los puntos no canjeados en una farmacia durante un periodo de tiempo"
     * )
     * @OA\Parameter(
     *      name="farmacia_id",
     *      in="path",
     *      description="ID de la farmacia",
     *      @OA\Schema(type="int")
     *  )
     * @OA\Parameter(
     *        name="fecha_inicio",
     *        in="path",
     *        description="la fecha debe tener el formato año mes dia, como por ejemplo: '2023-05-09'",
     *        @OA\Schema(type="string")
     *    )
     * @OA\Parameter(
     *         name="fecha_fin",
     *         in="path",
     *         description="la fecha debe tener el formato año mes dia, como por ejemplo: '2023-05-31'",
     *         @OA\Schema(type="string")
     *     )
     * @OA\Tag(name="Puntos otorgados y sin canjear en una farmacia durante un periodo")
     */
    public function contadorDePuntosNoCanjeadosEnFarmacia(Request $request): Response
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
     * @OA\Response(
     *     response=Response::HTTP_OK,
     *     description="Mostramos la cantidad(float) de los puntos no canjeados en una farmacia durante un periodo de tiempo para un cliente"
     * )
     * @OA\Parameter(
     *      name="farmacia_id",
     *      in="path",
     *      description="ID de la farmacia",
     *      @OA\Schema(type="int")
     *  )
     * @OA\Parameter(
     *        name="fecha_inicio",
     *        in="path",
     *        description="la fecha debe tener el formato año mes dia, como por ejemplo: '2023-05-09'",
     *        @OA\Schema(type="string")
     *  )
     * @OA\Parameter(
     *         name="fecha_fin",
     *         in="path",
     *         description="la fecha debe tener el formato año mes dia, como por ejemplo: '2023-05-31'",
     *         @OA\Schema(type="string")
     *  )
     * @OA\Parameter(
     *       name="cliente_id",
     *       in="path",
     *       description="ID del cliente",
     *       @OA\Schema(type="int")
     *   )
     * @OA\Tag(name="Puntos otorgados y sin canjear en una farmacia durante un periodo a un cliente")
     */
    public function contadorDePuntosNoCanjeadosEnFarmaciaPorCliente(Request $request): Response
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
