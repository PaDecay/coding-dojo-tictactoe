<?php

declare(strict_types=1);

namespace App\Application\ViewModel;

use App\Domain\Spielstein;

final class SpielsteinViewModel
{
    private string $label;
    private string $symbol;

    public function __construct(string $label, string $symbol)
    {
        $this->label = $label;
        $this->symbol = $symbol;
    }

    public static function fromSpielstein(Spielstein $spielstein): SpielsteinViewModel
    {
        $label = null;
        $symbol = null;

        if ($spielstein->istKreis()) {
            $label = 'Spieler 1';
            $symbol = 'Kreis';
        } elseif ($spielstein->istKreuz()) {
            $label = 'Spieler 2';
            $symbol = 'Kreuz';
        } else {
            throw new Exception('Ungültiger Spielstein.');
        }

        return new self($label, $symbol);
    }

    public function label(): string
    {
        return $this->label;
    }

    public function symbol(): string
    {
        return $this->symbol;
    }
}
