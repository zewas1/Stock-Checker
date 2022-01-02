<?php

namespace App\Controller;

use App\Entity\StockInformation;
use App\Service\MailService;
use App\Service\StockService;
use App\Service\StockTriggerService;
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
     * @var StockTriggerService
     */
    private StockTriggerService $trigger;

    /**
     * @var MailService
     */
    private MailService $mail;

    /**
     * @param StockService $helper
     * @param StockTriggerService $trigger
     * @param MailService $mail
     */
    public function __construct
    (
        StockService $helper,
        StockTriggerService $trigger,
        MailService $mail
    ) {
        $this->helper = $helper;
        $this->trigger = $trigger;
        $this->mail = $mail;
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

        $this->emailTrigger($entity);

        return $this->json([
            'data' => $entity,
        ]);
    }

    /**
     * @param StockInformation $entity
     */
    public function emailTrigger(StockInformation $entity): void
    {
        if ($this->trigger->hasSignificantChange($entity)) {
            $this->mail->sendEmail($entity);
        }
    }
}