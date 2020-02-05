<?php
namespace App\Domain;

use App\Domain\EmailSenderInterceptor\AfterSendInterceptor;
use App\Domain\EmailSenderInterceptor\BeforeSendInterceptor;
use App\Domain\EmailSenderInterceptor\Exception\BeforeSendInterceptorException;
use App\Domain\Transport\EmailTransport;

class EmailSender
{
    /** @var EmailTransport */
    private $transport;

    /** @var BeforeSendInterceptor[] */
    private $beforeSendInterceptors = [];

    /** @var AfterSendInterceptor[] */
    private $afterSendInterceptors = [];

    /**
     * EmailSender constructor.
     *
     * @param EmailTransport $transport
     */
    public function __construct(EmailTransport $transport)
    {
        $this->transport = $transport;
    }

    public function sendEmail(Email $email)
    {
        try {
            foreach ($this->beforeSendInterceptors as $interceptor) {
                $interceptor->beforeSend($email);
            }
        } catch (BeforeSendInterceptorException $e) {
            echo "\r\nCancelled sending email {$email->getRecipientAddress()} because: {$e->getMessage()}\r\n";
            return;
        }

        $this->transport->send($email);

        foreach ($this->afterSendInterceptors as $interceptor) {
            $interceptor->afterSend($email);
        }
    }

    public function addBeforeSendInterceptor(BeforeSendInterceptor $interceptor)
    {
        $this->beforeSendInterceptors[] = $interceptor;
    }

    public function addAfterSendInterceptor(AfterSendInterceptor $interceptor)
    {
        $this->afterSendInterceptors[] = $interceptor;
    }
}
