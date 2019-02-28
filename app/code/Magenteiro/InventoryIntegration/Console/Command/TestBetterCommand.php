<?php

namespace Magenteiro\InventoryIntegration\Console\Command;

use Magento\Catalog\Model\ResourceModel\Product\Collection;
use Magento\Framework\Model\ResourceModel\Iterator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestBetterCommand extends Command
{
    /**
     * @var OutputInterface
     */
    private $output;
    /**
     * @var Collection
     */
    private $productCollection;
    /**
     * @var Iterator
     */
    private $iterator;

    public function __construct(Collection $productCollection, Iterator $iterator)
    {
        parent::__construct();
        $this->productCollection = $productCollection;
        $this->iterator = $iterator;
    }

    protected function configure()
    {
        $this->setName('magenteiro:inventoryTestBetter')
             ->setDescription('Integração com o estoque, com loop otimizado.');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $products = $this->productCollection;
        $this->iterator->walk($products->getSelect(), [[$this, 'updateItens']]);

        $output->writeln('pico de memória: ' . memory_get_peak_usage() / 1024 / 1024 . 'MiB');
    }

    public function updateItens($args)
    {
        $sku = $args['row']['sku'];
        $this->output->writeln($sku);
    }
}