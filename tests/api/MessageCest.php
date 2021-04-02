<?php

namespace App\Tests\api;

use App\Entity\Message;
use App\Tests\ApiTester;

/**
 * php vendor/bin/codecept run api MessageCest
 */
class MessageCest
{
    public function _before(ApiTester $I)
    {
        $I->loadAllFixtures();
    }

    public function postMessage(ApiTester $I)
    {
        $I->haveHttpHeader('Content-Type', 'application/json');
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendPOST('/messages', [
            'email' => 'cest@cest.com',
            'title' => 'test title',
            'body' => 'test body'
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseContainsJson([
            "email" => "cest@cest.com",
            "title" => "test title",
            "body" => "test body"
        ]);
    }

    public function cantGetMessages(ApiTester $I)
    {
        $I->sendGET('/messages');
        $I->seeResponseCodeIs(405);
    }

    public function cantGetMessage(ApiTester $I)
    {
        /** @var Message $message */
        $message = $I->grabEntityFromRepository(Message::class, ['title' => 'title fixtures']);
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/messages/' . $message->getId());
        $I->seeResponseCodeIs(404);
    }

    public function cantDeleteMessages(ApiTester $I)
    {
        $I->sendDELETE('/messages/' . 1);
        $I->seeResponseCodeIs(405);
    }

    public function cantPutMessages(ApiTester $I)
    {
        $I->sendPUT('/messages/' . 1);
        $I->seeResponseCodeIs(405);
    }
}
