<?php

declare(strict_types=1);

namespace App\Common\Domain;

use ArrayIterator;
use IteratorAggregate;

abstract class Collection implements IteratorAggregate
{
    private array $items;

    public function __construct(array $items)
    {
        Assert::arrayOf($this->type(), $items);
        $this->items = $items;
    }

    abstract protected function type(): string;

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items());
    }

    public function items(): array
    {
        return $this->items;
    }
}
