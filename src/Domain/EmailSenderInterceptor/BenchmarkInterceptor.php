<?php
namespace App\Domain\EmailSenderInterceptor;

use App\Domain\Email;

class BenchmarkInterceptor implements BeforeSendInterceptor, AfterSendInterceptor
{
    /** @var float */
    private $start;

    /**
     * @inheritDoc
     */
    public function beforeSend(Email $email): void
    {
        echo __METHOD__ . "\r\n";
        $this->start = microtime(true);
    }

    /**
     * @inheritDoc
     */
    public function afterSend(Email $email): void
    {
        echo __METHOD__ . "\r\n";
        $now = microtime(true);

        $duration = $now - $this->start;

        echo "\r\n\tSending email took {$duration} seconds\r\n\r\n";
    }
}
