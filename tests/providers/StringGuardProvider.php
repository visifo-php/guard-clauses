<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests\providers;

class StringGuardProvider
{
    public static string $DEFAULT_VALUE = 'content';
    public static int $DEFAULT_LENGTH = 7;
    public static string $EMPTY = '';

    public function whitespaceProvider(): array
    {
        return [
            '    ' => ['    '],
            '  content  ' => ['  content  '],
            '  content' => ['  content'],
            'content  ' => ['content  '],
        ];
    }

    public function noWhitespaceProvider(): array
    {
        return [
            'content' => ['content'],
            'content content' => ['content content'],
        ];
    }

    public function exactLengthProvider(): array
    {
        return [
            'exact 7' => ['content', 7],
        ];
    }

    public function shortLengthProvider(): array
    {
        return [
            'short 0' => ['', 0],
            'short 6' => ['conten', 6],
        ];
    }

    public function longLengthProvider(): array
    {
        return [
            'long 8' => ['content+', 8],
            'long 15' => ['content content', 15],
        ];
    }
}
