<?php

namespace Visifo\GuardClauses;

class FloatGuard extends AbstractGuard
{
    public function __construct(?float $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }
}
