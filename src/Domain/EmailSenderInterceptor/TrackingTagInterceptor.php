<?php
namespace App\Domain\EmailSenderInterceptor;

use App\Domain\Email;
use App\Domain\EmailSenderInterceptor\Exception\BeforeSendInterceptorException;

class TrackingTagInterceptor implements BeforeSendInterceptor
{
    /**
     * @inheritDoc
     */
    public function beforeSend(Email $email): void
    {
        $email->setBody($email->getBody() . "==TrackingTag:1234");
    }
}