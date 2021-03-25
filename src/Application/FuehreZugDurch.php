<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\ViewModel\ViewDataBuilder;
use App\Domain\Zug;

final class FuehreZugDurch
{
    private Repository $repository;
    private EventDispatcher $eventDispatcher;
    private ViewDataBuilder $viewDataBuilder;

    public function __construct(
        Repository $repository,
        EventDispatcher $eventDispatcher,
        ViewDataBuilder $viewDataBuilder
    ) {
        $this->repository = $repository;
        $this->eventDispatcher = $eventDispatcher;
        $this->viewDataBuilder = $viewDataBuilder;
    }

    public function __invoke(int $x, int $y): void
    {
        $spiel = $this->repository->game();

        $zug = new Zug($x, $y);
        $spiel->zugDurchfuehren($zug);
        $this->eventDispatcher->dispatchAll($spiel->recordedEvents());
        $this->viewDataBuilder->addSpielbrett($spiel->spielbrett());
    }
}
