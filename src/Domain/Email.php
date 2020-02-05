<?php
namespace App\Domain;

class Email
{
    /** @var string */
    private $recipientAddress;

    /** @var string */
    private $recipientName;

    /** @var string */
    private $subject;

    /** @var string */
    private $body;

    /**
     * Email constructor.
     *
     * @param string $recipientAddress
     * @param string $recipientName
     * @param string $subject
     * @param string $body
     */
    public function __construct(string $recipientAddress, string $recipientName, string $subject, string $body)
    {
        $this->recipientAddress = $recipientAddress;
        $this->recipientName = $recipientName;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getRecipientAddress(): string
    {
        return $this->recipientAddress;
    }

    /**
     * @param string $recipientAddress
     */
    public function setRecipientAddress(string $recipientAddress): void
    {
        $this->recipientAddress = $recipientAddress;
    }

    /**
     * @return string
     */
    public function getRecipientName(): string
    {
        return $this->recipientName;
    }

    /**
     * @param string $recipientName
     */
    public function setRecipientName(string $recipientName): void
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return string
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     */
    public function setSubject(string $subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }
}
