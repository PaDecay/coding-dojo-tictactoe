<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Event\Event;
use App\Domain\Event\SpielWurdeGewonnen;
use App\Domain\Spielbrett\Groesse;
use App\Domain\Spielbrett\Spielbrett;

final class Spiel
{
    private Spielbrett $spielbrett;
    private Spielstein $spielsteinAmZug;
    /** @var array<Event>  */
    private array $events;

    private function __construct() //inject?
    {
        $groesse = new Groesse(Groesse::STANDARD_HOEHE, Groesse::STANDARD_BREITE);
        $this->spielbrett = Spielbrett::neuesSpielbrett($groesse);
        $this->spielsteinAmZug = Spielstein::kreis();
        $this->events = [];
    }

    public static function neuesSpiel(): Spiel
    {
        return new self();
    }

    public function zugDurchfuehren(Zug $zug): void
    {
        if (!$this->istZugGueltig($zug)) {
            return;
        }

        $this->spielbrett->platziereSpielstein($zug, $this->spielsteinAmZug);

        if ($zug->hatDasSpielGewonnen($this->spielbrett)) {
            $this->events[] = new SpielWurdeGewonnen($this->spielsteinAmZug);

            return;
        }

        $this->abwechseln();
    }

    public function spielbrett(): Spielbrett
    {
        return $this->spielbrett;
    }

    /**
     * @return array<Event>
     */
    public function recordedEvents(): array
    {
        return $this->events;
    }

    private function istZugGueltig(Zug $zug): bool
    {
        return $this->spielbrett->feldIstFrei($zug->x(), $zug->y());
    }

    private function abwechseln(): void
    {
        if ($this->spielsteinAmZug->istKreis()) {
            $this->spielsteinAmZug = Spielstein::kreuz();
        } else {
            $this->spielsteinAmZug = Spielstein::kreis();
        }
    }
}
