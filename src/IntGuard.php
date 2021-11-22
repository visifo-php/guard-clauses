<?php

namespace Visifo\GuardClauses;

class IntGuard extends AbstractGuard
{
    public function __construct(?int $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }
}
