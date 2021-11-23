<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use InvalidArgumentException;
use SplFileObject;

abstract class AbstractGuard
{
    protected mixed $value;
    protected bool $optional;
    protected bool $noValue;
    protected array $caller;

    protected function __construct(mixed $value, bool $optional, array $caller)
    {
        $this->value = $value;
        $this->caller = $caller;
        $this->optional = $optional;
        $this->noValue = !isset($value);
        if (!$this->optional && $this->noValue) {
            throw new InvalidArgumentException('Value must be optional to be null.');
        }
    }

    protected function getName(): string
    {
        if (count($this->caller) == 0) {
            return 'Argument';
        }

        $_file = new SplFileObject($this->caller['file']);
        $_file->seek($this->caller['line'] - 1);
        $line = $_file->current();
        $_file = null;

        preg_match("/{$this->caller['function']}\((.*?)\)/", $line, $output);

        return count($output) > 1 ? $output[1] : 'Argument';
    }

    protected function getTypeDescription(): string
    {
        $actualType = gettype($this->value);
        if (is_object($this->value)) {
            $actualType .= ":" . get_class($this->value);
        }

        return $actualType;
    }
}
