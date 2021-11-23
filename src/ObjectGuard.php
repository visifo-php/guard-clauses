<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;

class ObjectGuard extends AbstractGuard
{
    public function __construct(?object $value, bool $optional, array $caller)
    {
        parent::__construct($value, $optional, $caller);
    }

    public function type(string $type): ObjectGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if ($this->value instanceof $type) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} must be an instance of type {$type}. Actual: {$this->getTypeDescription()}.");
    }

    public function notType(string $type): ObjectGuard
    {
        if ($this->optional && $this->noValue) {
            return $this;
        }
        if (!($this->value instanceof $type)) {
            return $this;
        }

        throw new InvalidArgumentException("{$this->getName()} cannot be an instance of type {$type}. Actual: {$this->getTypeDescription()}.");
    }
}
