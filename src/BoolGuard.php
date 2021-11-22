<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class BoolGuard extends AbstractGuard
{
    public function __construct(?bool $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }

    public function true(): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === true) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be true. Actual: '{$this->value}'.");
    }

    public function false(): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === false) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be false. Actual: '{$this->value}'.");
    }
}
