<?php
namespace App\Domain\EmailSenderInterceptor;

use App\Domain\Email;
use App\Domain\EmailSenderInterceptor\Exception\BeforeSendInterceptorException;

class BlacklistInterceptor implements BeforeSendInterceptor
{
    /** @var string[] */
    private $blacklist = [];

    /**
     * BlacklistEmailSenderInterceptor constructor.
     *
     * @param string[] $blacklist
     */
    public function __construct(array $blacklist)
    {
        $this->blacklist = $blacklist;
    }

    /**
     * @inheritDoc
     */
    public function beforeSend(Email $email): void
    {
        echo __METHOD__ . "\r\n";

        if (in_array($email->getRecipientAddress(), $this->blacklist)) {
            throw new BeforeSendInterceptorException('Email is blacklisted');
        }
    }
}