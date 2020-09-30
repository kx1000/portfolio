<?php namespace App\Tests;
use App\Entity\Page;

/**
 * php vendor/bin/codecept run api PageCest
 */
class PageCest
{
    public function filterPage(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
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
                    "value" => "https://bitbucket.org/k1002/portfolio-sf/",
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
