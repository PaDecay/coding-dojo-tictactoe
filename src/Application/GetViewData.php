<?php

declare(strict_types=1);

namespace App\Application;

use App\Application\ViewModel\ViewData;
use App\Application\ViewModel\ViewDataBuilder;
use App\Domain\Spiel;

final class GetViewData
{
    private ViewDataBuilder $viewDataBuilder;

    public function __construct(ViewDataBuilder $viewDataBuilder)
    {
        $this->viewDataBuilder = $viewDataBuilder;
    }

    public function __invoke(): ViewData
    {
        return $this->viewDataBuilder->build();
    }
}
