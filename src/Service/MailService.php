<?php

namespace App\Service;

use App\Entity\StockInformation as Stock;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class MailService
{
    private const SUBJECT = "Stock monitoring alert";

    /**
     * @var string
     */
    private string $emailTo;

    /**
     * @var string
     */
    private string $host;

    /**
     * @var int
     */
    private int $port;

    /**
     * @var string
     */
    private string $username;

    /**
     * @var string
     */
    private string $password;

    /**
     * @param string $emailTo
     * @param string $host
     * @param int $port
     * @param string $username
     * @param string $password
     */
    public function __construct
    (
        string $emailTo,
        string $host,
        int $port,
        string $username,
        string $password,
    ) {
        $this->emailTo = $emailTo;
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @param Stock $stock
     * @throws Exception
     */
    public function sendEmail(Stock $stock): void
    {
        $mail = New PHPMailer();
        $this->buildMailerClient($mail);
        $mail->msgHTML($this->buildMessage($stock));
        if (!$mail->send()) {
            echo "Mailer Error: ";
            echo $mail->ErrorInfo;
        } else {
            echo "Email sent";
        }
    }

    /**
     * @param Stock $stock
     * @return string
     */
    private function buildMessage(Stock $stock): string
    {
        return "Stock has changed by " . $stock->getChangePercent() . "%.";
    }

    /**
     * @param PHPMailer $mail
     * @throws Exception
     */
    private function buildMailerClient(PHPMailer $mail): void
    {
        $mail->isSMTP();
        $mail->Debugoutput = 'html';
        $mail->Host = $this->host;
        $mail->Port = $this->port;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;

        $mail->Username = $this->username;
        $mail->Password = $this->password;
        $mail->setFrom($this->username, 'stock-alerts');
        $mail->addAddress($this->emailTo);
        $mail->Subject = self::SUBJECT;
    }
}