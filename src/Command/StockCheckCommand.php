<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\StockInformation;
use App\Service\StockService;
use GuzzleHttp\Exception\GuzzleException;
use PHPMailer\PHPMailer\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Service\StockTriggerService;
use App\Service\MailService;

class StockCheckCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected static $defaultName = 'app:check-stock';

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
     * @param string|null $name
     */
    public function __construct(
        StockService $helper,
        StockTriggerService $trigger,
        MailService $mail,
        string $name = null,
    ) {
        $this->helper = $helper;
        $this->trigger = $trigger;
        $this->mail = $mail;
        parent::__construct($name);
    }

    protected function configure()
    {
        parent::configure();

        $this->setDescription('Handles stock checking')
            ->addArgument('stock', InputArgument::REQUIRED, 'stock symbol input');
    }

    /**
     * @throws Exception|GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entity = $this->helper->handleStock($input->getArgument('stock'));
        $this->emailTrigger($entity);
    }

    /**
     * @param StockInformation $entity
     *
     * @throws Exception
     */
    private function emailTrigger(StockInformation $entity): void
    {
        if ($this->trigger->hasSignificantChange($entity)) {
            $this->mail->sendEmail($entity);
        }
    }
}