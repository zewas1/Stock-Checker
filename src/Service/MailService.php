<?php

namespace App\Service;

use App\Entity\StockInformation as Stock;

class MailService
{
    private const FROM = "alert@stock-checker.com";
    private const SUBJECT = "Stock monitoring alert";
    private const HEADERS = "From:" . self::FROM;

    /**
     * @var string
     */
    private string $emailTo;

    /**
     * @param string $emailTo
     */
    public function __construct(string $emailTo){
        $this->emailTo = $emailTo;
    }

    /**
     * @param Stock $stock
     */
    public function sendEmail(Stock $stock): void
    {
        $emailTo = $this->emailTo;
        $message = $this->buildMessage($stock);

        mail($emailTo, self::SUBJECT, $message, self::HEADERS);
    }

    /**
     * @param Stock $stock
     * @return string
     */
    private function buildMessage(Stock $stock): string
    {
        return "Stock has changed by " . $stock->getChangePercent() . "%.";
    }
}