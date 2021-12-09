<?php

namespace App\Controller;

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

    public function __construct(StockService $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return Response
     *
     * @throws GuzzleException
     */
    #[Route('/stock', name: 'stock')]
    public function index(): Response
    {
        $stock = "aapl";

        $entity = $this->helper->handleStock($stock);

        return $this->json([
            'data' => $entity,
        ]);
    }
}