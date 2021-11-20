<?php

declare(strict_types=1);

namespace Visifo\GuardClauses;

use SplFileObject;

class AbstractGuard
{
    protected array $caller;
    protected bool $optional;
    protected bool $noValue;

    protected function __construct(mixed $value, bool $optional, array $caller)
    {
        $this->caller = $caller;
        $this->optional = $optional;
        $this->noValue = !isset($value);
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

        return $output[1];
    }
}
