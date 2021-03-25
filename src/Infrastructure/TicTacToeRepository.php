<?php

declare(strict_types=1);

namespace App\Infrastructure;

use App\Application\FuehreZugDurch;
use App\Application\Repository;
use App\Application\StarteNeuesSpiel;
use App\Domain\Spiel;

final class TicTacToeRepository implements Repository
{
    private Spiel $spiel;

    private FuehreZugDurch $fuehreZugDurch;
    private StarteNeuesSpiel $starteNeuesSpiel;

    public function persistGame(Spiel $spiel): void
    {
        $this->spiel = $spiel;
    }

    public function game(): Spiel
    {
        return $this->spiel;
    }
}