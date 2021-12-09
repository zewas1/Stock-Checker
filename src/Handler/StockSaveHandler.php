<?php

namespace App\Handler;

use App\Entity\StockInformation as Stock;

class StockSaveHandler
{
    /**
     * @param
     *
     * @return Stock
     */
    public function save(): Stock
    {
        $stock = new Stock();
        $stock->setAskPrice();

        return $stock;
    }
}