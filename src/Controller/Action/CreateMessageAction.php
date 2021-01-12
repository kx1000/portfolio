<?php

namespace App\Controller\Action;

use App\Entity\Message;
use App\Factory\EmailFactory;
use Symfony\Component\Mailer\MailerInterface;

class CreateMessageAction
{
    /**
     * @var EmailFactory
     */
    private $emailFactory;
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(EmailFactory $emailFactory, MailerInterface $mailer)
    {
        $this->emailFactory = $emailFactory;
        $this->mailer = $mailer;
    }

    public function __invoke(Message $data): Message
    {
        $email = $this->emailFactory->createFromMessage($data);
        $this->mailer->send($email);

        return $data;
    }
}