<?php

declare(strict_types=1);

namespace App\Common\Domain;

use App\Common\Domain\Constant\Date;
use DateTimeImmutable;

trait DateTime
{
    public function convertStringToDate(?string $date, string $format = Date::FORMAT_STANDAR): ?DateTimeImmutable
    {
        if (null === $date) {
            return null;
        }

        $date = DateTimeImmutable::createFromFormat($format, $date);

        return false === $date ? null : $date;
    }
}
