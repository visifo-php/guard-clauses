<?php

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class StringGuard extends AbstractGuard
{
    public function __construct(?string $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }

    public function empty(): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (empty($this->value)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be empty. Actual: '{$this->value}'.");
    }

    public function notEmpty(): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!empty($this->value)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be empty. Actual: '{$this->value}'.");
    }

    public function noWhitespace(): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        $trimmed = trim($this->value);
        if ($this->value === $trimmed) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot start or end with whitespace. Actual: '{$this->value}'.");
    }

    public function length(int $count): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (strlen($this->value) === $count) {
            return $this;
        }

        $actualLength = strlen($this->value);

        throw new InvalidArgumentException("{$this->getName()} must have a lenght of '{$count}'. Actual: '{$actualLength}'.");
    }

    public function minLength(int $count): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (strlen($this->value) >= $count) {
            return $this;
        }

        $actualLength = strlen($this->value);

        throw new InvalidArgumentException("{$this->getName()} must have a minimum lenght of '{$count}'. Actual: '{$actualLength}'.");
    }

    public function maxLength(int $count): StringGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (strlen($this->value) <= $count) {
            return $this;
        }

        $actualLength = strlen($this->value);

        throw new InvalidArgumentException("{$this->getName()} must have a maximum lenght of '{$count}'. Actual: '{$actualLength}'.");
    }
}
