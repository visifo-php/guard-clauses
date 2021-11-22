<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests\providers;

class GuardProvider
{
    public function emptyProvider(): array
    {
        return [
            'empty-string' => [''],
            'empty-array' => [[]],
            'zero' => [0],
        ];
    }

    public static function notEmptyProvider(): array
    {
        return [
            'string' => ['value'],
            'whitespace' => ['   '],
            'array' => [['value']],
            'int' => [1],
            'float' => [1.5],
        ];
    }

    public function identicalProvider(): array
    {
        return [
            'bool' => [true, true],
            'string' => ['value', 'value'],
            'int' => [42, 42],
            'negative-int' => [-42, -42],
            'float' => [13.37, 13.37],
            'negative-float' => [-13.37, -13.37],
        ];
    }

    public function equalCornerCasesProvider(): array
    {
        return [
            'zero-string' => [0, '0'],
            'zero-false' => [0, false],
            'zero-null' => [0, null],
            'false-null' => [false, null],
            'int-bool' => [1, true],
            'int-float' => [1, 1.0],
            'int-string' => [1, '1'],
            'float-string' => [1.5, '1.5'],
        ];
    }

    public function notEqualProvider(): array
    {
        return [
            'null' => [42, null],
            'bool' => [true, false],
            'string' => ['', 'value'],
            'int' => [42, 84],
            'negative-int' => [42, -42],
            'float' => [13.37, 26.74],
            'negative-float' => [13.37, -13.37],
        ];
    }
}
