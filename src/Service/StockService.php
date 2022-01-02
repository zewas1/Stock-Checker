<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\StockBuilder;
use App\Entity\StockInformation as Stock;
use GuzzleHttp\Exception\GuzzleException;

class StockService
{
    /**
     * @var ApiCommunicationService
     */
    private ApiCommunicationService $api;

    /**
     * @var StockBuilder
     */
    private StockBuilder $builder;

    /**
     * @param ApiCommunicationService $api
     * @param StockBuilder $builder
     */
    public function __construct(ApiCommunicationService $api, StockBuilder $builder)
    {
        $this->api = $api;
        $this->builder = $builder;
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

        return $this->builder->buildStock($array);
    }
}