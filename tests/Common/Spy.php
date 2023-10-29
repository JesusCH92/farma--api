<?php

namespace App\Tests\Common;

abstract class Spy
{
    protected bool $validateWasCalled = false;

    public function verify(): bool
    {
        return $this->validateWasCalled;
    }
}