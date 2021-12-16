<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Tests\Entities;

use Fbsouzas\StringCalculator\Entities\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    private StringCalculator $stringCalculator;

    public function setUp(): void
    {
        $this->stringCalculator = new StringCalculator();
    }

    /** @test */
    public function itShouldReturnZero(): void
    {
        $result = $this->stringCalculator->add('');

        self::assertSame(0, $result);
    }

    /** @test */
    public function itShouldReturnAnInteger(): void
    {
        $result = $this->stringCalculator->add('3');

        self::assertIsInt($result);
    }

    /** @test */
    public function itShouldCalculateTheString(): void
    {
        $result = $this->stringCalculator->add('1,2,5');

        self::assertSame(8, $result);
    }

    /** @test */
    public function itShouldHandleWithNewLinesInTheString(): void
    {
        $result1 = $this->stringCalculator->add('1\n,2,3');
        $result2 = $this->stringCalculator->add('1,\n2,4');

        self::assertSame(6, $result1);
        self::assertSame(7, $result2);
    }
}
