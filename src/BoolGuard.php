<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class BoolGuard extends AbstractGuard
{
    private ?bool $value;

    public function __construct(?bool $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value = $value;
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

    public function equal(mixed $argument): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value == $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be equal to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notEqual(mixed $argument): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be equal to '{$argument}'. Actual: '{$this->value}'");
    }

    public function identical(mixed $argument): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be identical to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notIdentical(mixed $argument): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be identical to '{$argument}'. Actual: '{$this->value}'");
    }
}
