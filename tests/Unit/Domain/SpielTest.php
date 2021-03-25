<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;


use App\Domain\Event\SpielWurdeGewonnen;
use App\Domain\Spiel;
use App\Domain\Spielbrett\Groesse;
use App\Domain\Spielbrett\Spielbrett;
use App\Domain\Spielsteine;
use App\Domain\Zug;
use PHPUnit\Framework\TestCase;

final class SpielTest extends TestCase
{
    public function testWaehrendDesSpielsWerdenAbwechselndZuegeDurchgefuehrt()
    {
        $spiel = Spiel::neuesSpiel();
        $zug = new Zug(0, 1);
        $spiel->zugDurchfuehren($zug);

        self::assertEquals(Spielsteine::KREIS, $spiel->spielbrett()->spielstein(0,1 ));
    }

    public function testZuEinemSpielGehoertEinSpielBrett()
    {
        $spiel = Spiel::neuesSpiel();

        self::assertEquals(Spielbrett::neuesSpielbrett(new Groesse(3,3)), $spiel->spielbrett());
    }

    public function testSpielErfasstAlleEingetretenenEreignisse()
    {
        $spiel = Spiel::neuesSpiel();

        $zug1 = new Zug(0, 0);
        $zug2 = new Zug(0, 1);
        $zug3 = new Zug(1, 0);
        $zug4 = new Zug(0, 2);
        $zug5 = new Zug(2, 0);

        $spiel->zugDurchfuehren($zug1);
        $spiel->zugDurchfuehren($zug2);
        $spiel->zugDurchfuehren($zug3);
        $spiel->zugDurchfuehren($zug4);
        $spiel->zugDurchfuehren($zug5);

        self::assertEquals([new SpielWurdeGewonnen(Spielsteine::KREIS)], $spiel->recordedEvents());
    }
}