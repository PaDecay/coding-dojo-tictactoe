<?php

declare(strict_types=1);

namespace App\Application\Listener;

use App\Application\ViewModel\ViewDataBuilder;
use App\Domain\Event\Event;
use App\Domain\Event\EventListener;
use App\Domain\Event\SpielWurdeGewonnen;

final class WennSpielGewonnenWurdeDannGewinnerInDerViewMerken implements EventListener
{
    private ViewDataBuilder $viewDataBuilder;

    public function __construct(ViewDataBuilder $viewDataBuilder)
    {
        $this->viewDataBuilder = $viewDataBuilder;
    }

    public function __invoke(Event $event): void
    {
        if (!$event instanceof SpielWurdeGewonnen) {
            return;
        }

        $this->viewDataBuilder->addGewinner($event->gewinner());
    }
}
