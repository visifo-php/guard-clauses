<?php

declare(strict_types=1);

namespace Visifo\GuardClauses\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Visifo\GuardClauses\Guard;
use Visifo\GuardClauses\IntGuard;
use Visifo\GuardClauses\Tests\providers\IntGuardProvider;

class IntGuardTest extends TestCase
{
    /** @test */
    public function construct_when_valueIsNullAndIsRequired_then_throwException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Value must be optional to be null.');

        new IntGuard(null, false, []);
    }

    /** @test */
    public function construct_when_valueIsNull_then_succeed(): void
    {
        $result = new IntGuard(null, true, []);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test */
    public function construct_when_valueIsInt_then_succeed(): void
    {
        $value = 42;
        $result = new IntGuard($value, true, []);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test */
    public function zero_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->zero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     */
    public function zero_when_valueIsZero_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->zero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     */
    public function zero_when_valueIsNotZero_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->zero();
    }

    /** @test */
    public function notZero_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->notZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     */
    public function notZero_when_valueIsNotZero_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->notZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     */
    public function notZero_when_valueIsZero_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value cannot be 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->notZero();
    }

    /** @test */
    public function positive_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->positive();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     */
    public function positive_when_valueIsPositive_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->positive();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     */
    public function positive_when_valueIsNegativeOrZero_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be positive and bigger then 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->positive();
    }

    /** @test */
    public function negative_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->negative();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     */
    public function negative_when_valueIsNegative_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->negative();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     */
    public function negative_when_valueIsPositiveOrZero_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be negative and smaller then 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->negative();
    }

    /** @test */
    public function positiveOrZero_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->positiveOrZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     */
    public function positiveOrZero_when_valueIsPositiveOrZero_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->positiveOrZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     */
    public function positiveOrZero_when_valueIsNegative_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be positive or 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->positiveOrZero();
    }

    /** @test */
    public function negativeOrZero_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->negativeOrZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::negativeProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::zeroProvider()
     */
    public function negativeOrZero_when_valueIsNegativeOrZero_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->negativeOrZero();

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::positiveProvider()
     */
    public function negativeOrZero_when_valueIsZero_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be negative or 0. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->negativeOrZero();
    }

    /** @test */
    public function betweenIncluded_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->betweenIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function betweenIncluded_when_valueIsBetweenIncluded_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->betweenIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function betweenIncluded_when_valueIsBetweenIncludedReverted_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->betweenIncluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     */
    public function betweenIncluded_when_valueIsOutsideExcluded_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be between '-10' and '42' included them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->betweenIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     */
    public function betweenIncluded_when_valueIsOutsideExcludedReverted_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be between '-10' and '42' included them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->betweenIncluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);
    }

    /** @test */
    public function betweenExcluded_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->betweenExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     */
    public function betweenExcluded_when_valueIsBetweenExcluded_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->betweenExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     */
    public function betweenExcluded_when_valueIsBetweenExcludedReverted_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->betweenExcluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function betweenExcluded_when_valueIsOutsideIncluded_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be between '-10' and '42' excluded them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->betweenExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function betweenExcluded_when_valueIsOutsideIncludedReverted_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be between '-10' and '42' excluded them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->betweenExcluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);
    }

    /** @test */
    public function outsideIncluded_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->outsideIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function outsideIncluded_when_valueIsOutsideIncluded_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->outsideIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function outsideIncluded_when_valueIsOutsideIncludedReverted_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->outsideIncluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     */
    public function outsideIncluded_when_valueIsBetweenExcluded_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be outside '-10' and '42' included them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->outsideIncluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     */
    public function outsideIncluded_when_valueIsBetweenExcludedReverted_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be outside '-10' and '42' included them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->outsideIncluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);
    }

    /** @test */
    public function outsideExcluded_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->outsideExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     */
    public function outsideExcluded_when_valueIsOutsideExcluded_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->outsideExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::outsideProvider()
     */
    public function outsideExcluded_when_valueIsOutsideExcludedReverted_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->outsideExcluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function outsideExcluded_when_valueIsBetweenIncluded_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be outside '-10' and '42' excluded them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->outsideExcluded(IntGuardProvider::$BETWEEN_MIN_VALUE, IntGuardProvider::$BETWEEN_MAX_VALUE);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMinProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::betweenBorderMaxProvider()
     */
    public function outsideExcluded_when_valueIsBetweenIncludedReverted_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be outside '-10' and '42' excluded them. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->outsideExcluded(IntGuardProvider::$BETWEEN_MAX_VALUE, IntGuardProvider::$BETWEEN_MIN_VALUE);
    }

    /** @test */
    public function greater_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->greater(-100);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::greaterProvider()
     */
    public function greater_when_valueIsGreater_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->greater(IntGuardProvider::$COMPARE_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::lessProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::equalProvider()
     */
    public function greater_when_valueIsLessOrEqual_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be greater than '10'. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->greater(IntGuardProvider::$COMPARE_VALUE);
    }

    /** @test */
    public function less_when_valueIsOptional_then_succeed(): void
    {
        $result = Guard::argument(null)->isInt()->less(100);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::lessProvider()
     */
    public function less_when_valueIsLess_then_succeed(int $value): void
    {
        $result = Guard::argument($value)->isInt()->less(IntGuardProvider::$COMPARE_VALUE);

        $this->assertTrue($result instanceof IntGuard);
    }

    /** @test
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::greaterProvider()
     * @dataProvider \Visifo\GuardClauses\Tests\providers\IntGuardProvider::equalProvider()
     */
    public function less_when_valueIsGreaterOrEqual_then_throwException(int $value): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("\$value must be less than '10'. Actual: '{$value}'.");

        Guard::argument($value)->isInt()->less(IntGuardProvider::$COMPARE_VALUE);
    }
}
