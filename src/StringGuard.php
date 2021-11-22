<?php

namespace Visifo\GuardClauses;

class StringGuard extends AbstractGuard
{
    public function __construct(?string $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }
}
