<?php

declare(strict_types=1);

namespace App\Application\ViewModel;

use App\Domain\Spielbrett\Spielbrett;

final class SpielbrettViewModel
{
    public const KREUZ = 'X';
    public const KREIS = 'O';
    public const LEERES_FELD = '';
    /** @var array<array<string>>  */
    private array $grid;

    /** @param array<array<string>> $grid */
    private function __construct(array $grid)
    {
        $this->grid = $grid;
    }

    public static function zuSpielbrett(Spielbrett $spielbrett): SpielbrettViewModel
    {
        $felder = [];

        for ($reihenNr = 0; $reihenNr < $spielbrett->groesse->hoehe(); $reihenNr++) {
            $spalte = [];

            for ($spaltenNr = 0; $spaltenNr < $spielbrett->groesse->breite(); $spaltenNr++) {
                $spielstein = $spielbrett->spielstein($spaltenNr, $reihenNr);
                if($spielstein === null) {
                    continue;
                }

                if ($spielstein->istKreuz()) {
                    $spalte[] = self::KREUZ;
                } elseif ($spielstein->istKreis()) {
                    $spalte[] = self::KREIS;
                } else {
                    $spalte[] = self::LEERES_FELD;
                }
            }

            $felder[] = $spalte;
        }

        return new SpielbrettViewModel($felder);
    }

    /** @return array<array<string>> */
    public function getGrid(): array
    {
        return $this->grid;
    }
}
