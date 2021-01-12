<?php

namespace App\Tests\unit\Factory;

use App\Entity\Message;
use App\Factory\EmailFactory;
use App\Tests\UnitTester;

/**
 * php vendor/bin/codecept run unit Factory/EmailFactoryCest
 */
class EmailFactoryCest
{
    public function createFromMessage(UnitTester $I)
    {
        $message = (new Message())
            ->setEmail('test@test.pl')
            ->setTitle('Test title :)')
            ->setBody('Test body')
            ;

        $emailFactory = new EmailFactory();
        $email = $emailFactory->createFromMessage($message);
        $context = $email->getContext();

        $I->assertCount(1, $email->getTo());
        $I->assertEquals($_ENV['MAILER_ADDRESS'], $email->getTo()[0]->getAddress());
        $I->assertEquals('💬 New Portfolio Message from test@test.pl', $email->getSubject());
        $I->assertEquals('test@test.pl', $context['from']);
        $I->assertEquals('Test title :)', $context['subject']);
        $I->assertEquals('Test body', $context['body']);
    }
}
