<?php

namespace Magenteiro\PrimeiroModulo\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    protected function configure()
    {
        $this->setName('magenteiro:teste')
             ->setDescription('Nosso primeiro comando');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Olá Magenteiro');
        $output->writeln($this->formatText('>', '<'));
    }

    public function formatText($prefix, $suffix)
    {
        return "$prefix ALGUM TEXTO $suffix";
    }
}