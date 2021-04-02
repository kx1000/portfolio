<?php

namespace App\Tests\api;

use App\Entity\Page;
use App\Tests\ApiTester;

/**
 * php vendor/bin/codecept run api PageCest
 */
class PageCest
{
    public function _before(ApiTester $I)
    {
        $I->loadAllFixtures();
    }

    public function filterPage(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->haveHttpHeader('Accept-Language', 'pl');
        $I->sendGET('/pages?name=main');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            "name" => "main",
            "contents" => [
                [
                    "value" => "kacper.tech",
                    "name" => "header"
                ],
                [
                    "value" => "Kacper Rogula 2020",
                    "name" => "footer"
                ],
                [
                    "value" => "https://github.com/kx1000/portfolio",
                    "name" => "pageSource"
                ],
                [
                    "value" => "+48 574 189 841",
                    "name" => "phone"
                ],
                [
                    "value" => "kacper.rogula@gmail.com",
                    "name" => "email"
                ]
            ]
        ]);
    }

    public function cantPostPage(ApiTester $I)
    {
        $I->sendPOST('/pages');
        $I->seeResponseCodeIs(405);
    }

    public function cantDeletePage(ApiTester $I)
    {
        /** @var Page $page */
        $page = $I->grabEntityFromRepository(Page::class, ['name' => 'main']);
        $I->sendDELETE('/projects/' . $page->getId());
        $I->seeResponseCodeIs(405);
    }

    public function cantPutPage(ApiTester $I)
    {
        /** @var Page $page */
        $page = $I->grabEntityFromRepository(Page::class, ['name' => 'main']);
        $I->sendPUT('/projects/' . $page->getId());
        $I->seeResponseCodeIs(405);
    }
}
