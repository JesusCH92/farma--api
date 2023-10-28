<?php

declare(strict_types=1);

namespace App\Common\Domain;

final class Assert
{
    public static function arrayOf(string $class, array $items): void
    {
        foreach ($items as $item) {
            self::instanceOf($class, $item);
        }
    }

    private static function instanceOf(string $class, mixed $item)
    {
        if (!$item instanceof $class) {
            throw new \InvalidArgumentException(
                sprintf('El objecto <%s>, no es una instancia de <%s>', $class, get_class($item))
            );
        }
    }
}
