<?php

namespace App\Tests\Unit\Domain\Spielbrett;


use App\Domain\Spielbrett\Groesse;
use App\Domain\Spielbrett\Spielbrett;
use App\Domain\Spielsteine;
use PHPUnit\Framework\TestCase;

final class SpielbrettTest extends TestCase
{
    public function testSpielbrettWurdeErzeugt(): void
    {
        $groesse = new Groesse(3, 5);
        $spielbrett = Spielbrett::neuesSpielbrett($groesse);

        self::assertTrue($spielbrett instanceof Spielbrett);
    }

    public function testNeuesSpielbrettHatNurLeereFelder(): void
    {
        $groesse = new Groesse(Groesse::STANDARD_HOEHE, Groesse::STANDARD_BREITE);
        $spielbrett = Spielbrett::neuesSpielbrett($groesse);

        for($i = 0; $i < $spielbrett->groesse->hoehe(); $i++) {
            for($j = 0; $j < $spielbrett->groesse->breite(); $j++) {
                self::assertFalse($spielbrett->feldIstGefuellt($j, $i));
            }
        }
    }

    public function testAufDemSpielbrettKoennenSpielsteinePlatziertWerden(): void
    {
        $spielstein = Spielsteine::KREIS;
        $x = 1;
        $y = 2;
        $groesse = new Groesse(3, 3);
        $spielbrett = Spielbrett::neuesSpielbrett($groesse);

        $spielbrett->platziereSpielstein($x, $y, $spielstein);

        self::assertTrue($spielbrett->feldHat($spielstein, $x, $y));
    }

    public function testEsFindetHerausOfeinFeldGefuelltIst(): void
    {
        $spielbrett = Spielbrett::neuesSpielbrett(new Groesse(Groesse::STANDARD_HOEHE, Groesse::STANDARD_BREITE));

        self::assertFalse($spielbrett->feldIstGefuellt(0, 0));
    }

    public function testFeldKannSpielsteinEnthalten(): void
    {
        $spielbrett = Spielbrett::neuesSpielbrett(new Groesse(Groesse::STANDARD_HOEHE, Groesse::STANDARD_BREITE));
        $spielbrett->platziereSpielstein(2,2, Spielsteine::KREIS);

        self::assertEquals(Spielsteine::KREIS, $spielbrett->spielstein(2,2));
    }

    public function testFeldHatEinenBestimmtenSpielstein(): void
    {
        $spielstein = Spielsteine::KREIS;
        $spielbrett = Spielbrett::neuesSpielbrett(new Groesse(Groesse::STANDARD_HOEHE, Groesse::STANDARD_BREITE));
        $spielbrett->platziereSpielstein(0, 0, $spielstein);

        self::assertTrue($spielbrett->feldHat($spielstein, 0, 0));
    }
}