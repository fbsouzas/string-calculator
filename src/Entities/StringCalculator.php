<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Entities;

use Fbsouzas\StringCalculator\Exceptions\NegativesNotAllowedException;

final class StringCalculator
{
    /** @throws NegativesNotAllowedException */
    public function add(string $numbers): int
    {
        if ('' === $numbers) {
            return 0;
        }

        $delimiter = ',';

        if ($this->hasCustomDelimiter($numbers)) {
            $delimiter = $this->getCustomDelimiter($numbers);
            $numbers = $this->removeCustomDelimiterOfTheNumbers($delimiter, $numbers);
        }

        $numbers = $this->removeNewLines($numbers);
        $numbers = $this->removeNumbersLargerThan1000($numbers);
        $numbersSplitByDelimiter = $this->splitNumbersByDelimiter($numbers, $delimiter);

        if ($this->hasNegativesNumbers($numbers)) {
            $negativesNumbers = $this->getNegativesNumbers($numbersSplitByDelimiter);

            throw new NegativesNotAllowedException(
                'Negatives not allowed [' . implode(', ', $negativesNumbers) . ']'
            );
        }

        return (int) array_sum($numbersSplitByDelimiter);
    }

    private function hasCustomDelimiter(string $numbers): bool
    {
        return str_starts_with($numbers, '//');
    }

    private function getCustomDelimiter(string $numbers): string
    {
        $positionCustomDelimiter = (int) strpos($numbers, '\n');

        return str_replace(
            '//',
            '',
            str_split($numbers, $positionCustomDelimiter)[0]
        );
    }

    private function removeCustomDelimiterOfTheNumbers(string $delimiter, string $numbers): string
    {
        return str_replace('//' . $delimiter, '', $numbers);
    }

    private function removeNewLines(string $numbers): string
    {
        return str_replace('\n', ' ', $numbers);
    }

    private function removeNumbersLargerThan1000(string $numbers): string
    {
        return (string) preg_replace(
            '/100[1-9]|10[1-9][0-9]|1[1-9][0-9]{2}|[2-9][0-9]{3}|[1-9][0-9]{4,}/',
            '',
            $numbers
        );
    }

    private function hasNegativesNumbers(string $numbers): bool
    {
        return str_contains($numbers, '-');
    }

    /**
     * @param array<String> $numbers
     * @return array<String>
     */
    private function getNegativesNumbers(array $numbers): array
    {
        return array_filter($numbers, fn (int $number) => $number < 0);
    }

    /** @return array<String> */
    private function splitNumbersByDelimiter(string $numbers, string $delimiter): array
    {
        return preg_split("/[\{$delimiter}]+/", $numbers);
    }
}
