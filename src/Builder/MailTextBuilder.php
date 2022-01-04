<?php

declare(strict_types=1);

namespace App\Builder;

class MailTextBuilder
{
    /**
     * @param string $stockSymbol
     * @param string $changeType
     * @param $changeValue
     *
     * @return string
     */
    public function buildChangeMessage(string $stockSymbol, string $changeType, $changeValue): string
    {
        return "Stock: " . $stockSymbol . "\n Change type: " . $changeType . "\n Change Value: " . $changeValue;
    }
}