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
    }
}
