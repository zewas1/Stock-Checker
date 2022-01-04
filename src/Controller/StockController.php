<?php

declare(strict_types=1);

namespace App\Controller;

use App\SaveHandler\StockSaveHandler;
use App\Service\StockService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockController extends AbstractController
{
    /**
     * @var StockService
     */
    private StockService $helper;

    /**
     * @var StockSaveHandler
     */
    private StockSaveHandler $saveHandler;

    /**
     * @param StockService $helper
     * @param StockSaveHandler $saveHandler
     */
    public function __construct
    (
        StockService $helper,
        StockSaveHandler $saveHandler,
    ) {
        $this->helper = $helper;
        $this->saveHandler = $saveHandler;
    }

    /**
     * @param string $symbol
     *
     * @return Response
     *
     * @throws GuzzleException
     */
    #[Route('/stock/{symbol}', name: 'stock', methods:'GET')]
    public function index(string $symbol): Response
    {
        $entity = $this->helper->handleStock($symbol);

        return $this->json([
            'data' => $entity,
        ]);
    }

    /**
     * @param string $symbol
     *
     * @return Response
     *
     * @throws GuzzleException
     */
    #[Route('/stock/add/{symbol}', name: 'stock_save', methods: 'GET')]
    public function saveStock(string $symbol): Response
    {
        $entity = $this->helper->handleStock($symbol);
        $this->saveHandler->save($entity);

        return $this->json([
            'data' => $entity,
        ]);
    }
}