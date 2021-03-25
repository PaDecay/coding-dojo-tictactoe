<?php

declare(strict_types=1);

namespace App\Domain\Spielbrett;

use function assert;

final class Groesse
{
    public const STANDARD_BREITE = 3;
    public const STANDARD_HOEHE = 3;

    private int $hoehe;
    private int $breite;

    public function __construct(int $hoehe, int $breite)
    {
        assert($hoehe >= 0 && $breite >= 0);
        $this->hoehe = $hoehe;
        $this->breite = $breite;
    }

    public function hoehe(): int
    {
        return $this->hoehe;
    }

    public function breite(): int
    {
        return $this->breite;
    }

    public function gueltigeXKoordinate(int $x): bool
    {
        return $x < $this->breite && $x >= 0;
    }

    public function gueltigeYKoordinate(int $y): bool
    {
        return $y < $this->hoehe && $y >= 0;
    }
}
