<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Entities;

use Fbsouzas\StringCalculator\Exceptions\NegativesNotAllowedException;

final class StringCalculator
{
    public function add(string $numbers): int
    {
        if ('' === $numbers) {
            return 0;
        }

        $delimiter = ',';

        if (str_starts_with($numbers, '//')) {
            $positionCustomDelimiter = strpos($numbers, '\n');
            $splitNumbers = str_split($numbers, $positionCustomDelimiter);
            $delimiter = str_replace('//', '', $splitNumbers[0]);
            $numbers = str_replace('//' . $delimiter, '', $numbers);
        }

        $numbers = str_replace('\n', ' ', $numbers);

        if (str_contains($numbers, '-')) {
            throw new NegativesNotAllowedException('Negatives not allowed [' . $numbers . ']');
        }

        return array_sum(preg_split("/[\{$delimiter}]+/", $numbers));
    }
}
