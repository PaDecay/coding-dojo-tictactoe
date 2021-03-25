<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Spielbrett\Spielbrett;
use Exception;

final class Zug
{
    private int $x;
    private int $y;

    public function __construct(int $x, int $y)
    {
        if (!(0 <= $x && $x <= 2 && 0 <= $y && $y <= 2)) {
            return; //TODO exception & assertion
        }

        $this->x = $x;
        $this->y = $y;
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function hatDasSpielGewonnen(Spielbrett $spielbrett): bool
    {
        if ($this->dreiInEinerReiheHorizontal($spielbrett)) {
            return true;
        }

        if ($this->dreiInEinerReiheVertikal($spielbrett)) {
            return true;
        }

        if ($this->dreiInEinerReiheDiagonalSteigend($spielbrett)) {
            return true;
        }

        return $this->dreiInEinerReiheDiagonalFallend($spielbrett);
    }

    private function dreiInEinerReiheHorizontal(Spielbrett $spielbrett): bool
    {
        $inEinerReihe = 1;
        $spielstein = $spielbrett->spielstein($this->x, $this->y);
        if (!$spielstein instanceof Spielstein) {
            throw new Exception('Gesetzter Spielstein nicht vorhanden');
        }

        $xR = $this->x() + 1;   //Wieviele Felder rechts haben den gleichen Spielstein?
        while ($spielbrett->feldHat($spielstein, $xR, $this->y())) {
            $inEinerReihe++;
            $xR++;
        }

        $xL = $this->x() - 1;    //Wieviele Felder links haben den gleichen Spielstein?
        while ($spielbrett->feldHat($spielstein, $xL, $this->y())) {
            $inEinerReihe++;
            $xL--;
        }

        return $inEinerReihe >= 3;
    }

    private function dreiInEinerReiheVertikal(Spielbrett $spielbrett): bool
    {
        $inEinerReihe = 1;
        $spielstein = $spielbrett->spielstein($this->x, $this->y);
        if (!$spielstein instanceof Spielstein) {
            throw new Exception('Gesetzter Spielstein nicht vorhanden');
        }

        $yT = $this->y() - 1;
        while ($spielbrett->feldHat($spielstein, $this->x(), $yT)) {
            $inEinerReihe++;
            $yT--;
        }

        $yU = $this->y() + 1;
        while ($spielbrett->feldHat($spielstein, $this->x(), $yU)) {
            $inEinerReihe++;
            $yU++;
        }

        return $inEinerReihe >= 3;
    }

    private function dreiInEinerReiheDiagonalSteigend(Spielbrett $spielbrett): bool
    {
        $inEinerReihe = 1;
        $spielstein = $spielbrett->spielstein($this->x, $this->y);
        if (!$spielstein instanceof Spielstein) {
            throw new Exception('Gesetzter Spielstein nicht vorhanden');
        }

        $yO = $this->y() - 1;
        $xR = $this->x() + 1;
        while ($spielbrett->feldHat($spielstein, $xR, $yO)) {
            $inEinerReihe++;
            $yO--;
            $xR++;
        }

        $yU = $this->y() + 1;
        $xL = $this->x() - 1;
        while ($spielbrett->feldHat($spielstein, $xL, $yU)) {
            $inEinerReihe++;
            $yU++;
            $xL--;
        }

        return $inEinerReihe >= 3;
    }

    private function dreiInEinerReiheDiagonalFallend(Spielbrett $spielbrett): bool
    {
        $inEinerReihe = 1;
        $spielstein = $spielbrett->spielstein($this->x, $this->y);
        if (!$spielstein instanceof Spielstein) {
            throw new Exception('Gesetzter Spielstein nicht vorhanden');
        }

        $yO = $this->y() - 1;
        $xL = $this->x() - 1;
        while ($spielbrett->feldHat($spielstein, $xL, $yO)) {
            $inEinerReihe++;
            $yO--;
            $xL--;
        }

        $yU = $this->y() + 1;
        $xR = $this->x() + 1;
        while ($spielbrett->feldHat($spielstein, $xR, $yU)) {
            $inEinerReihe++;
            $yU++;
            $xR++;
        }

        return $inEinerReihe >= 3;
    }
}
