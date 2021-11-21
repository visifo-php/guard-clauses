<?php

namespace Visifo\GuardClauses;

class StringGuard extends AbstractGuard
{
    private ?string $value;

    public function __construct(?string $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value = $value;
    }
}
