<?php

declare(strict_types=1);

namespace Fbsouzas\StringCalculator\Commands;

use Fbsouzas\StringCalculator\Entities\StringCalculator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CalculateStringCommand extends Command
{
    protected static $defaultName = 'app:calculate-string';

    protected function configure(): void
    {
        $this
            ->addArgument('numbers', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $stringCalculator = new StringCalculator();

        $restult = $stringCalculator->add($input->getArgument('numbers'));

        $output->writeln("The result is: {$restult}");

        return Command::SUCCESS;
    }
}
