<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Framework;

use App\Common\Domain\Constant\Date;
use DateTimeImmutable;
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

    final protected function convertDateOrFail(
        ?string $dateString,
        string $format = Date::FORMAT_STANDAR
    ): DateTimeImmutable {
        $date = $this->convertStringToDate($dateString, $format);

        if (null === $date) {
            throw new \InvalidArgumentException(
                sprintf('La fecha <%s>, no tiene el formato <%s>', $dateString, $format)
            );
        }

        return $date;
    }
}
