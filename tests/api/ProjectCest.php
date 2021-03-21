<?php

namespace App\Tests\api;

use App\Entity\Project;
use App\Tests\ApiTester;

/**
 * php vendor/bin/codecept run api ProjectCest
 */
class ProjectCest
{
    public function _before(ApiTester $I)
    {
        $I->loadAllFixtures();
    }

    public function getProjects(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/projects');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            [
                "title" => "Projekt 1",
                "image" => null,
                "animation" => null,
                "slug" => "project-1",
                "links" => [
                    [
                        "icon" => "fab amazon",
                        "url" => "https://amazon.com",
                        "title" => "amazon"
                    ]
                ],
                "technologies" => [
                    [
                        "name" => "PHP"
                    ]
                ],
                "year" => "2020 - 2021",
                "body" => "Test projekt 1. EN"
            ],
            [
                "title" => "Projekt 2",
                "image" => null,
                "animation" => null,
                "slug" => "project-2",
                "links" => [],
                "technologies" => [],
                "year" => "2010",
                "body" => "Test projekt 2. EN"
            ],
            [
                "title" => "Projekt 3",
                "image" => null,
                "animation" => null,
                "slug" => "project-3",
                "links" => [],
                "technologies" => [],
                "year" => "2025",
                "body" => "Test projekt 3. EN"
            ]
        ]);
    }

    public function cantPostProject(ApiTester $I)
    {
        $I->sendPOST('/projects');
        $I->seeResponseCodeIs(405);
    }

    public function cantDeleteProject(ApiTester $I)
    {
        /** @var Project $project */
        $project = $I->grabEntityFromRepository(Project::class, ['title' => 'Projekt 1']);
        $I->sendDELETE('/projects/' . $project->getId());
        $I->seeResponseCodeIs(405);
    }

    public function cantPutProject(ApiTester $I)
    {
        /** @var Project $project */
        $project = $I->grabEntityFromRepository(Project::class, ['title' => 'Projekt 1']);
        $I->sendPUT('/projects/' . $project->getId());
        $I->seeResponseCodeIs(405);
    }
}
