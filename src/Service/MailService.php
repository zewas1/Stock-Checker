<?php

declare(strict_types=1);

namespace App\Service;

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
        int    $port,
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
     * @param string $message
     *
     * @throws Exception
     */
    public function sendEmail(string $message): void
    {
        $mail = new PHPMailer();
        $this->buildMailerClient($mail);
        $mail->msgHTML($message);
        $mail->send();
    }

    /**
     * @param PHPMailer $mail
     *
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