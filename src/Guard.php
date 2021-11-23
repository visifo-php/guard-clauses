<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

final class Guard extends AbstractGuard
{
    private function __construct(mixed $value, array $caller)
    {
        parent::__construct($value, true, $caller);
    }

    public static function argument(mixed $value): Guard
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];

        return new Guard($value, $caller);
    }

    public function null(): Guard
    {
        if ($this->noValue) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be null.");
    }

    public function notNull(): Guard
    {
        if (isset($this->value)) {
            $this->optional = false;
            $this->noValue = false;

            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be null.");
    }

    public function notEmpty(): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!empty($this->value)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be empty.");
    }

    public function empty(): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (empty($this->value)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be empty.");
    }

    public function equal(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value == $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be equal to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notEqual(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be equal to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function identical(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be identical to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notIdentical(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be identical to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function isBool(): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return new BoolGuard(null, $this->optional, $this->caller);
        }
        if (is_bool($this->value)) {
            return new BoolGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be bool. Actual: {$this->getTypeDescription()}.");
    }

    public function isString(): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return new StringGuard(null, $this->optional, $this->caller);
        }
        if (is_string($this->value)) {
            return new StringGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be string. Actual: {$this->getTypeDescription()}.");
    }

    public function isInt(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return new IntGuard(null, $this->optional, $this->caller);
        }
        if (is_int($this->value)) {
            return new IntGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be int. Actual: {$this->getTypeDescription()}.");
    }

    public function isFloat(): FloatGuard
    {
        if ($this->optional && $this->noValue) {
            return new FloatGuard(null, $this->optional, $this->caller);
        }
        if (is_float($this->value)) {
            return new FloatGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be float. Actual: {$this->getTypeDescription()}.");
    }

    public function isObject(): ObjectGuard
    {
        if ($this->optional && $this->noValue) {
            return new ObjectGuard(null, $this->optional, $this->caller);
        }
        if (is_object($this->value)) {
            return new ObjectGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be object. Actual: {$this->getTypeDescription()}.");
    }
}
