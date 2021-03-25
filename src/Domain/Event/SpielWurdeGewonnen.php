<?php

declare(strict_types=1);

namespace App\Domain\Event;

use App\Domain\Spielstein;

final class SpielWurdeGewonnen implements Event
{
    private Spielstein $gewinner;

    public function __construct(Spielstein $spielstein)
    {
        $this->gewinner = $spielstein;
    }

    public function gewinner(): Spielstein
    {
        return $this->gewinner;
    }
}
