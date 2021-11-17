<?php declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

final class Guard
{
    private mixed $value;
    private string $name;
    private bool $optional;
    private bool $noValue;

    private function __construct(mixed $value, string $name)
    {
        $this->value = $value;
        $this->name = $name;
        $this->optional = true;
        $this->noValue = !isset($value);
    }

    public static function argument(mixed $value, string $name = 'Argument'): Guard
    {
        return new Guard($value, $name);
    }

    public function notNull(): Guard
    {
        if (isset($this->value)) {
            $this->optional = false;
            $this->noValue = false;
            return $this;
        }

        throw new InvalidArgumentException("{$this->name} cannot be null.");
    }

    public function null(): Guard
    {
        if ($this->noValue) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} must be null.");
    }

    public function notEmpty(): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!empty($this->value)) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} cannot be empty.");
    }

    public function empty(): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (empty($this->value)) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} must be empty.");
    }

    public function type(string $type): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value instanceof $type) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} must be an instance of type {$type}. Actual: {$this->getTypeDescription()}");
    }

    public function notType(string $type): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!($this->value instanceof $type)) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} cannot be an instance of type {$type}. Actual: {$this->getTypeDescription()}");
    }

    private function getTypeDescription(): string
    {
        $actualType = gettype($this->value);
        if (is_object($this->value)) {
            $actualType .= " : " . get_class($this->value);
        }
        return $actualType;
    }

    public function equal(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value == $argument) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} must be equal to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notEqual(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} cannot be equal to '{$argument}'. Actual: '{$this->value}'");
    }

    public function identical(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value === $argument) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} must be identical to: '{$argument}'. Actual: '{$this->value}'.");
    }

    public function notIdentical(mixed $argument): Guard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value != $argument) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->name} cannot be identical to '{$argument}'. Actual: '{$this->value}'");
    }
}
