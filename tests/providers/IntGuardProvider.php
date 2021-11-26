<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests\providers;

class IntGuardProvider
{
    public static int $DEFAULT_VALUE = 10;
    public static int $BETWEEN_MIN_VALUE = -10;
    public static int $BETWEEN_MAX_VALUE = 42;
    public static array $ALLOWED_VALUE = [-5, 0, 5];
    public static array $FORBIDDEN_VALUE = [-10, 1, 10];

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

    public function betweenBorderMinProvider(): array
    {
        return [
            'int min border' => [self::$BETWEEN_MIN_VALUE],
        ];
    }

    public function betweenBorderMaxProvider(): array
    {
        return [
            'int max border' => [self::$BETWEEN_MAX_VALUE],
        ];
    }

    public function betweenProvider(): array
    {
        return [
            'int -9' => [-9],
            'int 0' => [0],
            'int 41' => [41],
        ];
    }

    public function outsideProvider(): array
    {
        return [
            'int min' => [PHP_INT_MIN],
            'int -11' => [-11],
            'int 43' => [43],
            'int max' => [PHP_INT_MAX],
        ];
    }

    public function greaterProvider(): array
    {
        return [
            'int 11' => [11],
            'int max' => [PHP_INT_MAX],
        ];
    }

    public function lessProvider(): array
    {
        return [
            'int 9' => [9],
            'int -10' => [-10],
            'int min' => [PHP_INT_MIN],
        ];
    }

    public function equalProvider(): array
    {
        return [
            'equal' => [self::$DEFAULT_VALUE],
        ];
    }

    public function allowedProvider(): array
    {
        return [
            'int -5' => [-5],
            'int 0' => [0],
            'int 5' => [5],
        ];
    }

    public function forbiddenProvider(): array
    {
        return [
            'int -10' => [-10],
            'int 1' => [1],
            'int 10' => [10],
        ];
    }
}
