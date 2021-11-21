<?php

namespace Visifo\GuardClauses\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Visifo\GuardClauses\Guard;

class GuardTest extends TestCase
{
    /** @test */
    public function argument_when_nullArgumentPassed_then_guardReturned(): void
    {
        $result = Guard::argument(null);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test */
    public function argument_when_notNullArgumentPassed_then_guardReturned(): void
    {
        $result = Guard::argument(42);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test */
    public function null_when_valueIsNull_then_succeed(): void
    {
        $result = Guard::argument(null)->null();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test */
    public function null_when_valueIsNotNull_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('42 must be null.');

        Guard::argument(42)->null();
    }

    /** @test */
    public function notNull_when_valueIsNotNull_then_succeed(): void
    {
        $result = Guard::argument(42)->notNull();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test */
    public function notNull_when_valueIsNull_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('null cannot be null.');

        Guard::argument(null)->notNull();
    }

    public function notEmptyProvider(): array
    {
        return [
            'string' => ['value'],
            'whitespace' => ['   '],
            'array' => [['value']],
            'int' => [1],
            'float' => [1.5],
        ];
    }

    public function emptyProvider(): array
    {
        return [
            'empty-string' => [''],
            'empty-array' => [[]],
            'zero' => [0],
        ];
    }

    /** @test */
    public function notEmpty_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->notEmpty();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEmptyProvider */
    public function notEmpty_when_valueIsNotEmpty_then_succeed(mixed $value): void
    {
        $result = Guard::argument($value)->notEmpty();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider emptyProvider */
    public function notEmpty_when_valueIsEmpty_then_throwException(mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$value cannot be empty.');

        Guard::argument($value)->notEmpty();
    }

    /** @test */
    public function empty_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->empty();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider emptyProvider */
    public function empty_when_valueIsEmpty_then_succeed(mixed $value): void
    {
        $result = Guard::argument($value)->empty();

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEmptyProvider */
    public function empty_when_valueIsNotEmpty_then_throwException(mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$value must be empty.');

        Guard::argument($value)->empty();
    }
}
