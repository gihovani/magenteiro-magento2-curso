<?php

namespace Magenteiro\PrimeiroPlugin\Plugin;

use Magenteiro\PrimeiroModulo\Console\Command\TestCommand;

class MeuPlugin
{
    public function beforeFormatText(TestCommand $subject, $prefix, $suffix)
    {
        $prefix = '>>';
        $suffix = '<<';
        return [$prefix, $suffix];
    }

    public function afterFormatText(TestCommand $subject, $result, $prefix, $suffix)
    {
        $result = str_replace('>', '|', $result);
        $result = str_replace('<', '|', $result);
        return $result;
    }

    public function aroundFormatText(TestCommand $subject, callable $proceed, $prefix, $suffix)
    {
        $result = '@@@' . $proceed($prefix, $suffix);
        return $result;
    }
}