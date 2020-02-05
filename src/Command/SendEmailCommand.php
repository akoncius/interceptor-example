<?php
namespace App\Command;

use App\Domain\Email;
use App\Domain\EmailSender;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendEmailCommand extends Command
{
    protected static $defaultName = 'app:send-email';

    /** @var EmailSender */
    private $emailSender;

    /**
     * TestCommand constructor.
     *
     * @param EmailSender $emailSender
     */
    public function __construct(EmailSender $emailSender)
    {
        $this->emailSender = $emailSender;

        parent::__construct(static::$defaultName);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->emailSender->sendEmail(new Email(
            'test@example.org',
            'John Doe',
            'VilniusPHP',
            'We invite you to amazing event called VilniusPHP!'
        ));

        $output->writeln("");
        $output->writeln("================================");
        $output->writeln("");

        $this->emailSender->sendEmail(new Email(
            'fraud@example.org',
            'John Doe',
            'VilniusPHP',
            'We invite you to amazing event called VilniusPHP!'
        ));
    }
}
