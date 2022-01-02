<?php

declare(strict_types=1);

namespace App\Builder;

use App\Entity\StockInformation as Stock;

class StockBuilder
{
    /**
     * @param $data
     *
     * @return Stock
     */
    public function buildStock($data): Stock
    {
        $stock = new Stock();

        $stock->setChange($data['change']);
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