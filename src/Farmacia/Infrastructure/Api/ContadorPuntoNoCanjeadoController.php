<?php

declare(strict_types=1);

namespace App\Farmacia\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Farmacia\ApplicationService\ContadorPuntoNoCanjeado;
use App\Farmacia\ApplicationService\DTO\ContadorPuntoNoCanjeadoRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api')]
final class ContadorPuntoNoCanjeadoController extends SymfonyApiController
{
    public function __construct(private readonly ContadorPuntoNoCanjeado $contadorPuntoNoCanjeado)
    {
    }

    #[Route('/puntos-sin-canjear', name: 'app_contador_punto_no_canjeado', methods: 'GET')]
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
