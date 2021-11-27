<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Visifo\GuardClauses\Guard;
use Visifo\GuardClauses\StringGuard;
use Visifo\GuardClauses\Tests\providers\StringGuardProvider;

class StringGuardTest extends TestCase
{
    /** @test */
    public function construct_when_valueIsNullAndIsRequired_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be optional to be null.');

        new StringGuard(null, false, []);
    }

    /** @test */
    public function construct_when_valueIsNull_then_succeed(): void
    {
        $result = new StringGuard(null, true, []);

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function construct_when_valueIsString_then_succeed(): void
    {
        $value = StringGuardProvider::$DEFAULT_VALUE;
        $result = new StringGuard($value, true, []);

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function empty_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isString()->empty();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function empty_when_valuIsEmpty_then_succeed(): void
    {
        $value = StringGuardProvider::$EMPTY;
        $result = Guard::argument($value)->isString()->empty();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function empty_when_valueIsNotEmpty_then_throwException(): void
    {
        $value = StringGuardProvider::$DEFAULT_VALUE;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be empty. Actual: 'content'.");

        Guard::argument($value)->isString()->empty();
    }

    /** @test */
    public function notEmpty_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isString()->notEmpty();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function notEmpty_when_valuIsNotEmpty_then_succeed(): void
    {
        $value = StringGuardProvider::$DEFAULT_VALUE;
        $result = Guard::argument($value)->isString()->notEmpty();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test */
    public function notEmpty_when_valueIsEmpty_then_throwException(): void
    {
        $value = StringGuardProvider::$EMPTY;

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value cannot be empty. Actual: ''.");

        Guard::argument($value)->isString()->notEmpty();
    }

    /** @test */
    public function noWhitespace_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isString()->noWhitespace();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\StringGuardProvider::noWhitespaceProvider()
     */
    public function noWhitespace_when_valueHasNoWhitespace_then_succeed(string $value): void
    {
        $result = Guard::argument($value)->isString()->noWhitespace();

        $this->assertTrue($result instanceof StringGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\StringGuardProvider::whitespaceProvider()
     */
    public function noWhitespace_when_valueHasWhitespace_then_throwException(string $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value cannot start or end with whitespace. Actual: '{$value}'.");

        Guard::argument($value)->isString()->noWhitespace();
    }
}
