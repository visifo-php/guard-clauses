<?php

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class IntGuard extends AbstractGuard
{
    public function __construct(?int $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }

    public function zero(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be 0. Actual: {$this->value}.");
    }
}
