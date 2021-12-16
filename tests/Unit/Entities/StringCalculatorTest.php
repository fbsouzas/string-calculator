<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Tests\Entities;

use Fbsouzas\StringCalculator\Entities\StringCalculator;
use Fbsouzas\StringCalculator\Exceptions\NegativesNotAllowedException;
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

    /** @test */
    public function itShouldSupportACustomDelimiter(): void
    {
        $result1 = $this->stringCalculator->add('//;\n1;3;4');
        $result2 = $this->stringCalculator->add('//$\n1$2$3');
        $result3 = $this->stringCalculator->add('//@\n2@3@8');
        $result4 = $this->stringCalculator->add('//@\n2@\n3@9');

        self::assertSame(8, $result1);
        self::assertSame(6, $result2);
        self::assertSame(13, $result3);
        self::assertSame(14, $result4);
    }

    /** @test */
    public function itShouldThrowANegativesNotAllowedException(): void
    {
        $this->expectException(NegativesNotAllowedException::class);

        $calculator = new StringCalculator();

        $calculator->add('//;\n1;-3;4');
    }

    /** @test */
    public function itShouldIgnoreNumbersLargerThan1000(): void
    {
        $result1 = $this->stringCalculator->add('2,1001');
        $result2 = $this->stringCalculator->add('2,1001,1002,1100,1500');
        $result3 = $this->stringCalculator->add('//$\n1$2$9999');
        $result4 = $this->stringCalculator->add('//@\n2@3@1100');
        $result5 = $this->stringCalculator->add('//@\n2@\n3@1111');

        self::assertSame(2, $result1);
        self::assertSame(2, $result2);
        self::assertSame(3, $result3);
        self::assertSame(5, $result4);
        self::assertSame(5, $result5);
    }

    /** @test */
    public function itShouldAllowArbitraryLengthDelimiters(): void
    {
        $result1 = $this->stringCalculator->add('//***\n1***2***3');
        $result2 = $this->stringCalculator->add('//**\n1**2**3');
        $result3 = $this->stringCalculator->add('//@@\n5@@2@@3');

        self::assertSame(6, $result1);
        self::assertSame(6, $result2);
        self::assertSame(10, $result3);
    }

    /** @test */
    public function itShouldAllowMultipleDelimiters(): void
    {
        $result1 = $this->stringCalculator->add('//$,@\n1$2@3');
        $result2 = $this->stringCalculator->add('//*,!\n1*2!3');
        $result3 = $this->stringCalculator->add('//@,&\n5@2&3');

        self::assertSame(6, $result1);
        self::assertSame(6, $result2);
        self::assertSame(10, $result3);
    }

    /** @test */
    public function itShouldAllowArbitraryLengthDelimitersAndMultipleDelimiters(): void
    {
        $result1 = $this->stringCalculator->add('//$$$,@@@\n1$$$2@@@3');
        $result2 = $this->stringCalculator->add('//****,!!!!\n1****2!!!!3');
        $result3 = $this->stringCalculator->add('//@@@@@,&&&&&\n5@@@@@2&&&&&3');

        self::assertSame(6, $result1);
        self::assertSame(6, $result2);
        self::assertSame(10, $result3);
    }
}
