<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Tests\Entities;

use Fbsouzas\StringCalculator\Entities\StringCalculator;
use PHPUnit\Framework\TestCase;

class StringCalculatorTest extends TestCase
{
    /** @test */
    public function itShouldReturnZero(): void
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add('');

        self::assertSame(0, $result);
    }

    /** @test */
    public function itShouldReturnAnInteger(): void
    {
        $stringCalculator = new StringCalculator();

        $result = $stringCalculator->add('3');

        self::assertIsInt($result);
    }
}
