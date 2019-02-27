<?php

namespace Magenteiro\MinhaPreferencia\Models;

use Magenteiro\PrimeiroModulo\Console\Command\TestCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestePreference extends TestCommand
{
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Olá Mundo!!!');
        $output->writeln($this->formatText('>', '<'));
    }
}