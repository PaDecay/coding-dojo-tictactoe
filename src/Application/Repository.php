<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\Spiel;

interface Repository
{
    public function persistGame(Spiel $spiel): void;
    public function game(): Spiel;
}
