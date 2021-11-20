<?php

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class StringGuard extends AbstractGuard
{
    private ?string $value;

    public function __construct(?string $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);

        $this->value = $value;
    }

    public function equal(mixed $argument): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value == $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be equal to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notEqual(mixed $argument): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be equal to '{$argument}'. Actual: '{$this->value}'");
    }

    public function identical(mixed $argument): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be identical to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notIdentical(mixed $argument): StringGuard
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
