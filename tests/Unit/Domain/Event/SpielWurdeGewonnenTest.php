<?php
declare(strict_types=1);

namespace App\Tests\Unit\Domain\Event;


use App\Domain\Event\SpielWurdeGewonnen;
use App\Domain\Spielsteine;
use PHPUnit\Framework\TestCase;

final class SpielWurdeGewonnenTest extends TestCase
{
    private SpielWurdeGewonnen $event;

    public function setUp(): void
    {
        $this->event = new SpielWurdeGewonnen(Spielsteine::KREIS);
    }

    public function testWennDasSpielGewonnenWurdeStehtDerGewinnerFest()
    {
        self::assertEquals(Spielsteine::KREIS,  $this->event->gewinner());
    }
}