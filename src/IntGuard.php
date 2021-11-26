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

        throw new InvalidArgumentException("{$this->getName()} must be 0. Actual: '{$this->value}'.");
    }

    public function notZero(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value !== 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be 0. Actual: '{$this->value}'.");
    }

    public function positive(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value > 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be positive and bigger then 0. Actual: '{$this->value}'.");
    }

    public function negative(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value < 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be negative and smaller then 0. Actual: '{$this->value}'.");
    }

    public function positiveOrZero(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value >= 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be positive or 0. Actual: '{$this->value}'.");
    }

    public function negativeOrZero(): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value <= 0) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be negative or 0. Actual: '{$this->value}'.");
    }

    public function betweenIncluded(int $from, int $to): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        $min = min($from, $to);
        $max = max($from, $to);
        if ($min <= $this->value && $this->value <= $max) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be between '{$min}' and '{$max}' included them. Actual: '{$this->value}'.");
    }

    public function betweenExcluded(int $from, int $to): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        $min = min($from, $to);
        $max = max($from, $to);
        if ($min < $this->value && $this->value < $max) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be between '{$min}' and '{$max}' excluded them. Actual: '{$this->value}'.");
    }

    public function outsideIncluded(int $from, int $to): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        $min = min($from, $to);
        $max = max($from, $to);
        if ($this->value <= $min || $max <= $this->value) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be outside '{$min}' and '{$max}' included them. Actual: '{$this->value}'.");
    }

    public function outsideExcluded(int $from, int $to): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        $min = min($from, $to);
        $max = max($from, $to);
        if ($this->value < $min || $max < $this->value) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be outside '{$min}' and '{$max}' excluded them. Actual: '{$this->value}'.");
    }

    public function greater(int $argument): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value > $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be greater than '{$argument}'. Actual: '{$this->value}'.");
    }

    public function less(int $argument): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value < $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be less than '{$argument}'. Actual: '{$this->value}'.");
    }

    public function greaterOrEqual(int $argument): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value >= $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be greater or equal than '{$argument}'. Actual: '{$this->value}'.");
    }

    public function lessOrEqual(int $argument): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value <= $argument) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be less or equal than '{$argument}'. Actual: '{$this->value}'.");
    }

    public function allowed(int ...$arguments): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        foreach ($arguments as $argument) {
            if ($this->value === $argument) {
                return $this;
            }
        }

        $allowed = implode(", ", $arguments);

        throw new InvalidArgumentException("{$this->getName()} must be one of '{$allowed}'. Actual: '{$this->value}'.");
    }

    public function forbidden(int ...$arguments): IntGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        foreach ($arguments as $argument) {
            if ($this->value === $argument) {
                $forbidden = implode(", ", $arguments);

                throw new InvalidArgumentException("{$this->getName()} cannot be one of '{$forbidden}'. Actual: '{$this->value}'.");
            }
        }

        return $this;
    }
}
