<?php

declare(strict_types=1);

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

    /**
     * @param StockService $helper
     */
    public function __construct
    (
        StockService $helper,
    ) {
        $this->helper = $helper;
    }

    /**
     * @param string $symbol
     *
     * @return Response
     *
     * @throws GuzzleException
     */
    #[Route('/stock/{symbol}', name: 'stock')]
    public function index(string $symbol): Response
    {
        $entity = $this->helper->handleStock($symbol);

        return $this->json([
            'data' => $entity,
        ]);
    }
}