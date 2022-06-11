<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\StockBuilder;
use App\Entity\Stock as Stock;
use App\SaveHandler\AbstractSaveHandler;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

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
     * @var AbstractSaveHandler
     */
    private AbstractSaveHandler $saveHandler;

    /**
     * @param ApiCommunicationService $api
     * @param StockBuilder $builder
     * @param AbstractSaveHandler $saveHandler
     */
    public function __construct(ApiCommunicationService $api, StockBuilder $builder, AbstractSaveHandler $saveHandler)
    {
        $this->api = $api;
        $this->builder = $builder;
        $this->saveHandler = $saveHandler;
    }

    /**
     * @param string $stockSymbol
     *
     * @return int
     *
     * @throws GuzzleException
     */
    public function createStock(string $stockSymbol): int
    {
        $stock = $this->getStock($stockSymbol);

        if (!$stock){
            return Response::HTTP_BAD_REQUEST;
        }

        $this->saveHandler->save($stock);

        return Response::HTTP_OK;
    }

    /**
     * @param string $stockSymbol
     *
     * @return Stock|null
     *
     * @throws GuzzleException
     */
    public function getStock(string $stockSymbol): ?Stock
    {
        $response = $this->api->makeApiCall($stockSymbol);

        if (!$response){
            return null;
        }

        return $this->builder->buildStock(json_decode($response, true));
    }
}