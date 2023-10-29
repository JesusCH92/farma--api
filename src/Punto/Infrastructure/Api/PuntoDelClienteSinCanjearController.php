<?php

declare(strict_types=1);

namespace App\Punto\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Punto\ApplicationService\Find\PuntosNoCanjeadosPorCliente;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
final class PuntoDelClienteSinCanjearController extends SymfonyApiController
{
    public function __construct(private readonly PuntosNoCanjeadosPorCliente $puntosNoCanjeadosPorCliente)
    {
    }

    #[Route('/cliente-puntos-disponibles', name: 'app_punto_no_canjeado_por_cliente', methods: 'GET')]
    public function puntosNoCanjeadosDelCliente(Request $request): JsonResponse
    {
        $response = ($this->puntosNoCanjeadosPorCliente)($request->query->getInt('cliente_id'));

        return $this->response(['puntos' => $response->cantidadTotal()]);
    }
}
