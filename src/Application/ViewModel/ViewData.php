<?php

declare(strict_types=1);

namespace App\Application\ViewModel;

final class ViewData
{
    private ?SpielbrettViewModel $viewModel;
    private ?SpielsteinViewModel $gewinner;

    public function __construct(
        ?SpielbrettViewModel $viewModel,
        ?SpielsteinViewModel $gewinner = null
    ) {
        $this->viewModel = $viewModel;
        $this->gewinner = $gewinner;
    }

    public function viewModel(): ?SpielbrettViewModel
    {
        return $this->viewModel;
    }

    public function gewinner(): ?SpielsteinViewModel
    {
        return $this->gewinner;
    }
}
