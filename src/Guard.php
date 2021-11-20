<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

final class Guard extends AbstractGuard
{
    private mixed $value;

    private function __construct(mixed $value, array $caller)
    {
        parent::__construct($value, true, $caller);

        $this->value = $value;
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

    public function type(string $type): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value instanceof $type) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be an instance of type {$type}. Actual: {$this->getTypeDescription()}");
    }

    public function notType(string $type): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!($this->value instanceof $type)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be an instance of type {$type}. Actual: {$this->getTypeDescription()}");
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

        throw new InvalidArgumentException("{$this->getName()} cannot be equal to '{$argument}'. Actual: '{$this->value}'");
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

        throw new InvalidArgumentException("{$this->getName()} cannot be identical to '{$argument}'. Actual: '{$this->value}'");
    }

    public function isBool(): BoolGuard
    {
        if ($this->optional && $this->noValue) {
            return new BoolGuard(null, $this->optional, $this->caller);
        }
        if (is_bool($this->value)) {
            return new BoolGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be bool. Actual: {$this->getTypeDescription()}");
    }

    public function isString(): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return new StringGuard(null, $this->optional, $this->caller);
        }
        if (is_string($this->value)) {
            return new StringGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be bool. Actual: {$this->getTypeDescription()}");
    }

    public function isInt(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return new IntGuard(null, $this->optional, $this->caller);
        }
        if (is_int($this->value)) {
            return new IntGuard($this->value, $this->optional, $this->caller);
        }

        throw new InvalidArgumentException("{$this->getName()} must be bool. Actual: {$this->getTypeDescription()}");
    }

    private function getTypeDescription(): string
    {
        $actualType = gettype($this->value);
        if (is_object($this->value)) {
            $actualType .= " : " . get_class($this->value);
        }

        return $actualType;
    }
}
