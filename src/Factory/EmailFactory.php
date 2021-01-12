<?php


namespace App\Factory;


use App\Entity\Message;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class EmailFactory
{
    public function createFromMessage(Message $message): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from(new Address($message->getEmail(), $_ENV['MAILER_NAME']))
            ->subject('💬 New Portfolio Message from ' . $message->getEmail())
            ->to($_ENV['MAILER_ADDRESS'])
            ->htmlTemplate('message/admin_email.html.twig')
            ->context([
                'from' => $message->getEmail(),
                'subject' => $message->getTitle(),
                'body' => $message->getBody(),
            ]);
    }
}