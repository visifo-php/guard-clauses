<?php

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class IntGuard extends AbstractGuard
{
    private ?int $value;

    public function __construct(?int $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value = $value;
    }
}
