<?php

namespace App\Service;

use App\Entity\StockInformation as Stock;

class StockTriggerService
{
    private const significantDecreasePercentage = -10;
    private const significantIncreasePercentage = 10;

    public function checkStock(Stock $stock)
    {

    }

    private function checkChange (Stock $stock){
        if ($stock->getChangePercent() < self::significantDecreasePercentage){

        }
    }
}