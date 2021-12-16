<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Entities;

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

        return array_sum(preg_split("/[\{$delimiter}]+/", $numbers));
    }
}
