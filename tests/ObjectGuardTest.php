<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Visifo\GuardClauses\Guard;
use Visifo\GuardClauses\ObjectGuard;

class ObjectGuardTest extends TestCase
{
    /** @test */
    public function construct_when_valueIsNullAndIsRequired_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be optional to be null.');

        new ObjectGuard(null, false, []);
    }

    /** @test */
    public function construct_when_valueIsNull_then_succeed(): void
    {
        $result = new ObjectGuard(null, true, []);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function construct_when_valueIsObject_then_succeed(): void
    {
        $value = Guard::argument(42)->isInt();
        $result = new ObjectGuard($value, true, []);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function type_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isObject()->type(Guard::class);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function type_when_valueIsValid_then_succeed(): void
    {
        $value = Guard::argument(42);
        $result = Guard::argument($value)->isObject()->type(Guard::class);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function type_when_valueIsInvalid_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$value must be an instance of type Visifo\GuardClauses\Guard. Actual: object:Visifo\GuardClauses\IntGuard.');

        $value = Guard::argument(42)->isInt();
        Guard::argument($value)->isObject()->type(Guard::class);
    }

    /** @test */
    public function notType_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isObject()->notType(Guard::class);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function notType_when_valueIsValid_then_succeed(): void
    {
        $value = Guard::argument(42)->isInt();
        $result = Guard::argument($value)->isObject()->notType(Guard::class);

        $this->assertTrue($result instanceof ObjectGuard);
    }

    /** @test */
    public function notType_when_valueIsInvalid_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('$value cannot be an instance of type Visifo\GuardClauses\Guard. Actual: object:Visifo\GuardClauses\Guard.');

        $value = Guard::argument(42);
        Guard::argument($value)->isObject()->notType(Guard::class);
    }
}
