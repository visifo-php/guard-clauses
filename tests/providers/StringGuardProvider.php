<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests\providers;

class StringGuardProvider
{
    public static string $DEFAULT_VALUE = 'content';
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
}
