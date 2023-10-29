<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Find\PuntosNoCanjeadosPorCliente;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use OpenApi\Annotations as OA;


#[Route('/api')]
final class PuntoDelClienteSinCanjearController extends SymfonyApiController
{
    public function __construct(private readonly PuntosNoCanjeadosPorCliente $puntosNoCanjeadosPorCliente)
    {
    }

    #[Route('/cliente-puntos-disponibles', name: 'app_punto_no_canjeado_por_cliente', methods: 'GET')]
    /**
     * @OA\Response(
     *     response=Response::HTTP_OK,
     *     description="Mostramos la cantidad(float) de los puntos no canjeados de un cliente en particular"
     * )
     * @OA\Parameter(
     *      name="cliente_id",
     *      in="path",
     *      description="ID del cliente",
     *      @OA\Schema(type="int")
     *  )
     * @OA\Tag(name="Cantidad de puntos sin canjear del cliente")
     */
    public function puntosNoCanjeadosDelCliente(Request $request): JsonResponse
    {
        $response = ($this->puntosNoCanjeadosPorCliente)($request->query->getInt('cliente_id'));

        return $this->response(['puntos' => $response->cantidadTotal()]);
    }
}
