<?php

namespace Magenteiro\InventoryIntegration\Console\Command;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    /**
     * @var Collection
     */
    private $productCollection;

    public function __construct(Collection $productCollection)
    {
        parent::__construct();
        $this->productCollection = $productCollection;
    }

    protected function configure()
    {
        $this->setName('magenteiro:inventoryTest')
            ->setDescription('Integração com o estoque.');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $products = $this->productCollection;
        foreach ($products->toArray() as $item) {
            $output->writeln($item['sku']);
        }

        $output->writeln('pico de memória: ' . memory_get_peak_usage() / 1024 / 1024 . 'MiB');
    }
}