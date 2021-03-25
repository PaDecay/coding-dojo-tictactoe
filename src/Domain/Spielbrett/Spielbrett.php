<?php

declare(strict_types=1);

namespace App\Domain\Spielbrett;

use App\Domain\Spielstein;
use App\Domain\Zug;

final class Spielbrett
{
    public Groesse $groesse;

    /** @var array<array<int|null>>  */
    private array $felder;

    /**
     * @param array<array<int|null>> $felder
     */
    private function __construct(Groesse $groesse, array $felder)
    {
        $this->groesse = $groesse;
        $this->felder = $felder;
    }

    public static function neuesSpielbrett(Groesse $groesse): Spielbrett
    {
        $felder = [];
        for ($i = 0; $i < $groesse->breite(); $i++) {
            $spalte = [];
            for ($j = 0; $j < $groesse->hoehe(); $j++) {
                $spalte[] = null;
            }

            $felder[] = $spalte;
        }

        return new self($groesse, $felder);
    }

    public function platziereSpielstein(Zug $zug, Spielstein $spielstein): void
    {
        $this->felder[$zug->x()][$zug->y()] = $spielstein;
    }

    public function feldIstFrei(int $x, int $y): bool
    {
        return $this->felder[$x][$y] === null;
    }

    public function spielstein(int $x, int $y): ?Spielstein
    {
        return $this->felder[$x][$y];
    }

    public function feldHat(Spielstein $spielstein, int $x, int $y): bool
    {
        if (!$this->groesse->gueltigeXKoordinate($x) || !$this->groesse->gueltigeYKoordinate($y)) {
            return false;
        }

        if($this->spielstein($x, $y) === null) {
            return false;
        }

        return $this->spielstein($x, $y)->istGleich($spielstein);
    }
}
