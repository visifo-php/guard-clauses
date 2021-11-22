<?php

declare(strict_types=1);

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

    /** @test */
    public function equal_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->equal(42);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider identicalProvider @dataProvider equalCornerCasesProvider */
    public function equal_when_valueIsEqual_then_succeed(mixed $argument, mixed $value): void
    {
        $result = Guard::argument($argument)->equal($value);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEqualProvider */
    public function equal_when_valueIsNotEqual_then_throwException(mixed $argument, mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$argument must be equal to: '{$value}'. Actual: '{$argument}'.");

        Guard::argument($argument)->equal($value);
    }

    /** @test */
    public function notEqual_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->notEqual(null);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEqualProvider */
    public function notEqual_when_valueIsNotEqual_then_succeed(mixed $argument, mixed $value): void
    {
        $result = Guard::argument($argument)->notEqual($value);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider identicalProvider @dataProvider equalCornerCasesProvider */
    public function notEqual_when_valueIsEqual_then_throwException(mixed $argument, mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$argument cannot be equal to: '{$value}'. Actual: '{$argument}'.");

        Guard::argument($argument)->notEqual($value);
    }

    /** @test */
    public function identical_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->identical(42);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider identicalProvider */
    public function identical_when_valueIsIdentical_then_succeed(mixed $argument, mixed $value): void
    {
        $result = Guard::argument($argument)->identical($value);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEqualProvider @dataProvider equalCornerCasesProvider */
    public function identical_when_valueIsNotIdentical_then_throwException(mixed $argument, mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$argument must be identical to: '{$value}'. Actual: '{$argument}'.");

        Guard::argument($argument)->identical($value);
    }

    /** @test */
    public function notIdentical_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->notIdentical(null);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider notEqualProvider */
    public function notIdentical_when_valueIsNotEqual_then_succeed(mixed $argument, mixed $value): void
    {
        $result = Guard::argument($argument)->notIdentical($value);

        $this->assertTrue($result instanceof Guard);
    }

    /** @test @dataProvider identicalProvider @dataProvider equalCornerCasesProvider */
    public function notIdentical_when_valueIsEqual_then_throwException(mixed $argument, mixed $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$argument cannot be identical to: '{$value}'. Actual: '{$argument}'.");

        Guard::argument($argument)->notIdentical($value);
    }
}
