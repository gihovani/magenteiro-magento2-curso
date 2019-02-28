<?php

namespace Magenteiro\InventoryIntegration\Cron;

use Magento\Catalog\Ui\DataProvider\Product\ProductCollectionFactory;
use Magento\CatalogInventory\Api\StockRegistryInterface;
use Magento\Framework\Model\ResourceModel\Iterator;
use Psr\Log\LoggerInterface;

class InventoryUpdate
{
    /**
     * @var StockRegistryInterface
     */
    private $stockRegistry;
    /**
     * @var Iterator
     */
    private $iterator;
    /**
     * @var ProductCollectionFactory
     */
    private $productCollectionFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(StockRegistryInterface $stockRegistry,
                                Iterator $iterator,
                                ProductCollectionFactory $productCollectionFactory,
                                LoggerInterface $logger)
    {
        $this->stockRegistry = $stockRegistry;
        $this->iterator = $iterator;
        $this->productCollectionFactory = $productCollectionFactory;
        $this->logger = $logger;
    }

    public function execute()
    {
        $products = $this->productCollectionFactory->create();
        $this->iterator->walk($products->getSelect(), [[$this, 'updateItems']]);
    }

    public function updateItems($args)
    {
        $sku = $args['row']['sku'];
        $stockItem = $this->stockRegistry->getStockItemBySku($sku);
        $currentQty = $stockItem->getQty();
        $newQty = 123.0;
        if ($currentQty === $newQty) {
            return;
        }

        $stockItem->setQty($newQty);
        $stockItem->setIsInStock(($newQty > 0));
        $this->logger->info('Atualizando o inventário...', ['sku'      => $sku, 'qtd aterior' => $currentQty,
                                                             'qtd nova' => $newQty]);
        $this->stockRegistry->updateStockItemBySku($sku, $stockItem);
    }
}