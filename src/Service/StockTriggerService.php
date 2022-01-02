<?php

namespace App\Service;

use App\Entity\StockInformation as Stock;

class StockTriggerService
{
    private const SIGNIFICANT_DECREASE_PERCENTAGE = -10;
    private const SIGNIFICANT_INCREASE_PERCENTAGE = 10;

    /**
     * @param Stock $stock
     *
     * @return bool
     */
    public function hasSignificantChange(Stock $stock): bool
    {
        if ($stock->getChangePercent() < self::SIGNIFICANT_DECREASE_PERCENTAGE ||
            $stock->getChangePercent() > self::SIGNIFICANT_INCREASE_PERCENTAGE) {
            return true;
        }

        return false;
    }
}