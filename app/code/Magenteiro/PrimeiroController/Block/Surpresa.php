<?php
namespace Magenteiro\PrimeiroController\Block;

class Surpresa extends \Magento\Framework\View\Element\Template
{
    // Métodos públicos ficam disponíveis dentro do phtml na variável $block
    public function getHello()
    {
        return "Hello Magenteiro!";
    }
}