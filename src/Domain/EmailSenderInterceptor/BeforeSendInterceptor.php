<?php
namespace App\Domain\EmailSenderInterceptor;

use App\Domain\Email;
use App\Domain\EmailSenderInterceptor\Exception\BeforeSendInterceptorException;

interface BeforeSendInterceptor
{
    /**
     * @param Email $email
     *
     * @return void
     * @throws BeforeSendInterceptorException
     */
    public function beforeSend(Email $email): void;
}
