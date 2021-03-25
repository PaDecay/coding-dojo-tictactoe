<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain;


use App\Domain\Spielbrett\Groesse;
use App\Domain\Spielbrett\Spielbrett;
use App\Domain\Zug;
use PHPUnit\Framework\TestCase;

final class ZugTest extends TestCase
{
    private Zug $zug;

    public function setUp(): void
    {
        $this->zug = new Zug(1,2);
    }

    public function testZugBestehtAusEinerXKoordinate()
    {
        self::assertEquals(1, $this->zug->x());
    }

    public function testZugBestehtAusEinerYKoordinate()
    {
        self::assertEquals(2, $this->zug->y());
    }

    public function testKannPruefenObEinPlatzierterSpielsteinDasSpielGewonnenHat()
    {
        $spielbrett = Spielbrett::neuesSpielbrett(new Groesse(3, 3));

        self::assertEquals(false, $this->zug->hatDasSpielGewonnen($spielbrett));
    }
}