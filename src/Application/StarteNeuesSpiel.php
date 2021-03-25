<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\ViewModel\ViewDataBuilder;
use App\Domain\Spiel;

final class StarteNeuesSpiel
{
    private Repository $repository;
    private ViewDataBuilder $viewDataBuilder;

    public function __construct(Repository $repository, ViewDataBuilder $viewDataBuilder)
    {
        $this->repository = $repository;
        $this->viewDataBuilder = $viewDataBuilder;
    }

    public function __invoke(): void
    {
        $spiel = Spiel::neuesSpiel();
        $this->repository->persistGame($spiel);
        $this->viewDataBuilder->clear();
        $this->viewDataBuilder->addSpielbrett($spiel->spielbrett());
    }
}
