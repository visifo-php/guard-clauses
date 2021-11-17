<?php declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;
use SplFileObject;

final class Guard
{
    private mixed $value;
    private bool $optional;
    private bool $noValue;
    private array $caller;

    private function __construct(mixed $value, array $caller)
    {
        $this->value = $value;
        $this->optional = true;
        $this->noValue = !isset($value);
        $this->caller = $caller;
    }

    public static function argument(mixed $value): Guard
    {
        $caller = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)[0];
        return new Guard($value, $caller);
    }

    private function getName(): string
    {
        if (count($this->caller) == 0) {
            return 'Argument';
        }

        $file = new SplFileObject($this->caller['file']);
        $file->seek($this->caller['line'] - 1);
        $line = $file->current();
        $file = null;

        preg_match("/{$this->caller['function']}\((.*?)\)/", $line, $output);
        return $output[1];
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

    public function null(): Guard
    {
        if ($this->noValue) {
            return $this;
        }
        throw new InvalidArgumentException("{$this->getName()} must be null.");
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
}
