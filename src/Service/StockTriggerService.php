<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\MailTextBuilder;
use App\Entity\StockInformation as Stock;

class StockTriggerService
{
    private const SIGNIFICANT_DECREASE_PERCENTAGE = -10;
    private const SIGNIFICANT_INCREASE_PERCENTAGE = 10;
    private const SIGNIFICANT_CHANGE = 'significant change';
    private const YEAR_HIGHEST_VALUE = 'highest value this year';
    private const YEAR_LOWEST_VALUE = 'lowest value this year';

    /**
     * @var MailTextBuilder
     */
    private MailTextBuilder $builder;

    /**
     * @param MailTextBuilder $builder
     */
    public function __construct(MailTextBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param Stock $stock
     * @return string|null
     */
    public function validate(Stock $stock): ?string
    {
        if ($this->hasSignificantChange($stock)) {
            return $this->builder->buildChangeMessage($stock->getSymbol(), self::SIGNIFICANT_CHANGE,
                $stock->getChangePercent());
        }

        if ($this->highestThisYear($stock)) {
            return $this->builder->buildChangeMessage($stock->getSymbol(), self::YEAR_HIGHEST_VALUE,
                $stock->getLatestPrice());
        }

        if ($this->lowestThisYear($stock)) {
            return $this->builder->buildChangeMessage($stock->getSymbol(), self::YEAR_LOWEST_VALUE,
                $stock->getLatestPrice());
        }

        return null;
    }

    /**
     * @param Stock $stock
     *
     * @return bool
     */
    private function hasSignificantChange(Stock $stock): bool
    {
        if ($stock->getChangePercent() < self::SIGNIFICANT_DECREASE_PERCENTAGE ||
            $stock->getChangePercent() > self::SIGNIFICANT_INCREASE_PERCENTAGE) {
            return true;
        }

        return false;
    }

    /**
     * @param Stock $stock
     * @return bool
     */
    private function highestThisYear(Stock $stock): bool
    {
        if ($stock->getLatestPrice() === $stock->getYearHigh()) {
            return true;
        }

        return false;
    }

    private function lowestThisYear(Stock $stock): bool
    {
        if ($stock->getLatestPrice() === $stock->getYearLow()) {
            return true;
        }

        return false;
    }
}