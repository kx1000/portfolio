<?php namespace App\Tests;
use App\DataFixtures\ProjectFixtures;
use App\Entity\Project;
use App\Tests\ApiTester;

/**
 * php vendor/bin/codecept run api ProjectCest
 */
class ProjectCest
{
    public function getProjects(ApiTester $I)
    {
        $I->haveHttpHeader('accept', 'application/json');
        $I->sendGET('/projects');
        $I->seeResponseCodeIs(200);
        $I->seeResponseContainsJson([
            "title" => "Projekt 1",
            "body" => "Test projekt 1.",
            "image" => null,
            "animation" => null,
            "slug" => "project-1",
            "listOrder" => null,
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
