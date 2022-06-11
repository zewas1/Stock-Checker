<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\StockRepository;
use App\Service\StockService;
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
     * @var StockRepository
     */
    private StockRepository $repository;

    /**
     * @param StockService $helper
     * @param StockRepository $repository
     */
    public function __construct
    (
        StockService    $helper,
        StockRepository $repository
    ) {
        $this->helper = $helper;
        $this->repository = $repository;
    }

    /**
     * Gets all saved stocks
     *
     * @return Response
     */
    #[Route('/stocks', name: 'index', methods: 'GET')]
    public function index(): Response
    {
        $stocks = $this->repository->findAll();

        return $this->json($stocks);
    }

    /**
     * Retrieves information on any stock
     *
     * @param string $stockSymbol
     *
     * @return Response
     *
     * @throws GuzzleException
     */
    #[Route('/stock/{stockSymbol}', name: 'get-stock', methods: 'GET')]
    public function getStock(string $stockSymbol): Response
    {
        $entity = $this->helper->getStock($stockSymbol);

        return $this->json([
            'data' => $entity,
        ]);
    }

    /**
     * Saves stock
     *
     * @param string $stockSymbol
     *
     * @return int
     *
     * @throws GuzzleException
     */
    #[Route('/stock/create/{stockSymbol}', name: 'create', methods: 'POST')]
    public function saveStock(string $stockSymbol): int
    {
        return $this->helper->createStock($stockSymbol);
    }
}