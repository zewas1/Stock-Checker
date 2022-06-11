<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\Stock;

class StockBuilder
{
    /**
     * @param array $data
     *
     * @return Stock
     */
    public function buildStock(array $data): Stock
    {
        $stock = new Stock();

        $stock->setChangeValue($data['change']);
        $stock->setChangePercent($data['changePercent']);
        $stock->setCompanyName($data['companyName']);
        $stock->setCurrency($data['currency']);
        $stock->setLatestPrice($data['latestPrice']);
        $stock->setSymbol($data['symbol']);
        $stock->setYearHigh($data['week52High']);
        $stock->setYearLow($data['week52Low']);
        $stock->setYtdChange($data['ytdChange']);
        $stock->setIsUsMarketOpen($data['isUSMarketOpen']);

        return $stock;
    }
}