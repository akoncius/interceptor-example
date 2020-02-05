<?php
namespace App\Domain\EmailSenderInterceptor;

use App\Domain\Email;

interface AfterSendInterceptor
{
    /**
     * @param Email $email
     *
     * @return void
     */
    public function afterSend(Email $email): void;
}
