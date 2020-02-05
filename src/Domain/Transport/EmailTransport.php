<?php


namespace App\Domain\Transport;


use App\Domain\Email;

class EmailTransport
{
    public function send(Email $email): void
    {
        echo "\r\n\tSending email to {$email->getRecipientAddress()}\r\n\r\n";
        usleep(3000);
    }
}