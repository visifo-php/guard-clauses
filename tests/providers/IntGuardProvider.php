<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests\providers;

class IntGuardProvider
{
    public function positiveProvider(): array
    {
        return [
            'int 1' => [1],
            'int 42' => [42],
            'int max' => [PHP_INT_MAX],
        ];
    }

    public function zeroProvider(): array
    {
        return [
            'int 0' => [0],
        ];
    }

    public function negativeProvider(): array
    {
        return [
            'int -1' => [-1],
            'int -42' => [-42],
            'int min' => [PHP_INT_MIN],
        ];
    }
}
