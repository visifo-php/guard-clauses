<?php

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class FloatGuard extends AbstractGuard
{
    private ?float $value;

    public function __construct(?float $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value = $value;
    }
}
