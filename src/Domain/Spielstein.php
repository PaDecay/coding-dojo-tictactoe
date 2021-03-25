<?php
declare(strict_types=1);

namespace App\Domain;


final class Spielstein
{
    private const KREUZ = 0;
    private const KREIS = 1;

    private int $symbol;

    private function __construct(int $symbol)
    {
        $this->symbol = $symbol;
    }

    public static function kreuz()
    {
        return new self(0);
    }

    public static function kreis()
    {
        return new self(1);
    }

    public function istGleich(Spielstein $spielstein)
    {
        return $this->symbol === $spielstein->symbol;
    }

    public function istKreis()
    {
        return $this->symbol === self::KREIS;
    }

    public function istKreuz()
    {
        return $this->symbol === self::KREUZ;
    }
}