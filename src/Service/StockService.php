<?php

namespace App\Service;

use App\Entity\StockInformation as Stock;
use GuzzleHttp\Exception\GuzzleException;

class StockService
{
    /**
     * @var ApiCommunicationService
     */
    private ApiCommunicationService $api;

    /**
     * @param ApiCommunicationService $api
     */
    public function __construct(ApiCommunicationService $api){
        $this->api=$api;
    }

    /**
     * @param string $stock
     *
     * @return Stock
     *
     * @throws GuzzleException
     */
    public function handleStock(string $stock): Stock
    {
        $response = $this->api->makeCall($stock);
        $array = json_decode($response, true);
        return $this->arrayToEntity($array);
    }

    /**
     * @param $response
     *
     * @return Stock
     */
    public function arrayToEntity($response): Stock
    {
        $stock = new Stock();

        $stock->setChange($response['change']);
        $stock->setChangePercent($response['changePercent']);
        $stock->setCompanyName($response['companyName']);
        $stock->setCurrency($response['currency']);
        $stock->setLatestPrice($response['latestPrice']);
        $stock->setSymbol($response['symbol']);
        $stock->setYearHigh($response['week52High']);
        $stock->setYearLow($response['week52Low']);
        $stock->setYtdChange($response['ytdChange']);
        $stock->setIsUsMarketOpen($response['isUSMarketOpen']);

        return $stock;
    }
}