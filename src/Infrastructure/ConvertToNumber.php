<?php

declare(strict_types=1);

namespace App\Infrastructure;

use function array_search;
use function assert;
use function is_int;
use function range;

final class ConvertToNumber
{
    public function __invoke(string $letter): int
    {
        $alphabet = range('A', 'Z');
        $number = array_search($letter, $alphabet);
        assert(is_int($number));

        return $number;
    }
}
