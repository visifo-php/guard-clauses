<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

class BoolGuard extends AbstractGuard
{
    private ?bool $value;

    public function __construct(?bool $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value == $value;
    }


}
