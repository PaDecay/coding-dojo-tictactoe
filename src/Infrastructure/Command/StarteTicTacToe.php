<?php

declare(strict_types=1);

namespace App\Infrastructure\Command;

use App\Application\FuehreZugDurch;
use App\Application\GetViewData;
use App\Application\StarteNeuesSpiel;
use App\Application\ViewModel\SpielbrettViewModel;
use App\Application\ViewModel\SpielsteinViewModel;
use App\Application\ViewModel\ViewData;
use App\Domain\Spiel;
use App\Infrastructure\ConvertToNumber;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Helper\TableSeparator;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

use function array_unshift;
use function in_array;
use function intval;

// phpcs:disable SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingAnyTypeHint
final class StarteTicTacToe extends Command
{
    protected static $defaultName = 'app:tictactoe';
    private StarteNeuesSpiel $starteNeuesSpiel;
    private FuehreZugDurch $fuehreZugDurch;
    private GetViewData $getViewData;

    public function __construct(
        ?string $name = null,
        StarteNeuesSpiel $starteNeuesSpiel,
        FuehreZugDurch $fuehreZugDurch,
        GetViewData $getViewData
    ) {
        parent::__construct($name);

        $this->starteNeuesSpiel = $starteNeuesSpiel;
        $this->fuehreZugDurch = $fuehreZugDurch;
        $this->getViewData = $getViewData;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');
        $question = new Question('tictactoe: ', 'command');

        while ($running = true) {
            $cliInput = $helper->ask($input, $output, $question);
            if ($cliInput === 'ende') {
                break;
            }

            if ($cliInput === 'neu') {
                ($this->starteNeuesSpiel)();
            }

            if (!$this->spielIstAmLaufen(($this->getViewData)())) {
                $output->writeln('"ende" oder "neu" eingeben.');
                continue;
            }

            if ($this->istKoordinate($cliInput)) {
                ($this->fuehreZugDurch)($this->berechneX($cliInput), $this->berechneY($cliInput));
            }

            $this->zeigeAusgabeAn(($this->getViewData)(), $output);
        }

        return Command::SUCCESS;
    }

    private function zeigeAusgabeAn(ViewData $viewData, OutputInterface $output): void
    {
        $this->zeigeSpielbrett($output, $viewData->viewModel());
        $this->zeigeGewinnerAn($output, $viewData->gewinner());
    }

    private function zeigeSpielbrett(OutputInterface $output, ?SpielbrettViewModel $viewModel): void
    {
        if ($viewModel === null) {
            return;
        }

        $table = new Table($output);
        $table->setHeaders([' ', 'A', 'B', 'C']);

        $r1 = $viewModel->getGrid()[0];
        $r2 = $viewModel->getGrid()[1];
        $r3 = $viewModel->getGrid()[2];

        array_unshift($r1, '0');
        array_unshift($r2, '1');
        array_unshift($r3, '2');

        $table->setRows([
            $r1,
            new TableSeparator(),
            $r2,
            new TableSeparator(),
            $r3,
        ]);
        $table->render();
    }

    private function zeigeGewinnerAn(OutputInterface $output, ?SpielsteinViewModel $gewinner): void
    {
        if ($gewinner === null) {
            return;
        }

        $output->writeln('Der Gewinner ist ' . $gewinner->label() . ' - ' . $gewinner->symbol());
    }

    private function berechneX(string $cliInput): int
    {
        $converter = new ConvertToNumber();

        return ($converter)($cliInput[0]);
    }

    private function berechneY(string $cliInput): int
    {
        return intval($cliInput[1]);
    }

    private function istKoordinate(string $cliInput): bool
    {
        return in_array($cliInput[0], ['A', 'B', 'C']) && in_array($cliInput[1], [0, 1, 2]);
    }

    private function spielIstAmLaufen(ViewData $viewData): bool
    {
        return !$viewData->gewinner();
    }
}
