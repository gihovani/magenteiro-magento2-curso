<?php

namespace Magenteiro\PrimeiroController\Controller\Meucontroller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ResponseInterface;

class Surpresa extends Action
{

    /**
     * Execute action based on request and return result
     *
     * Note: Request will be added as operation argument in future
     *
     * @return \Magento\Framework\Controller\ResultInterface|ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function execute()
    {
        echo 'surpresa gg2!';
    }
}