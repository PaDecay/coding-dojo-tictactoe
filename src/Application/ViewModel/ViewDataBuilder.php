<?php

declare(strict_types=1);

namespace App\Application\ViewModel;

use App\Domain\Spielbrett\Spielbrett;
use App\Domain\Spielstein;

final class ViewDataBuilder
{
    private ?Spielstein $gewinner;
    private ?Spielbrett $spielbrett;

    public function __construct()
    {
        $this->spielbrett = null;
        $this->gewinner = null;
    }

    public function build(): ViewData
    {
        $gewinnerViewModel = null;
        if ($this->gewinner) {
            $gewinnerViewModel = SpielsteinViewModel::fromSpielstein($this->gewinner);
        }

        $spielbrettViewModel = null;
        if ($this->spielbrett) {
            $spielbrettViewModel = SpielbrettViewModel::zuSpielbrett($this->spielbrett);
        }

        return new ViewData(
            $spielbrettViewModel,
            $gewinnerViewModel
        );
    }

    public function addSpielbrett(?Spielbrett $spielbrett): void
    {
        $this->spielbrett = $spielbrett;
    }

    public function addGewinner(Spielstein $spielstein): void
    {
        $this->gewinner = $spielstein;
    }

    public function clear(): void
    {
        $this->spielbrett = null;
        $this->gewinner = null;
    }
}
