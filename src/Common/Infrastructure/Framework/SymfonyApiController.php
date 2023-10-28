<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Framework;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class SymfonyApiController extends AbstractController
{
    final protected function response(array $data, ?int $statusResponse = null): JsonResponse
    {
        $statusResponse = $statusResponse ?? Response::HTTP_OK;

        return new JsonResponse(['data' => $data], $statusResponse);
    }
}
