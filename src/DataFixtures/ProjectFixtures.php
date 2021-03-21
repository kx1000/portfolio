<?php

namespace App\DataFixtures;

use App\Entity\Link;
use App\Entity\Project;
use App\Entity\Technology;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $project1 = (new Project())
            ->setTitle('Projekt 1')
            ->setSlug('project-1')
            ->setYear('2020 - 2021')
            ->addLink(
                (new Link())
                    ->setIcon('fab amazon')
                    ->setTitle('amazon')
                    ->setUrl('https://amazon.com')
            )
            ->addTechnology(
                (new Technology())
                    ->setName('PHP')
            );
        $project1->setCurrentLocale($_ENV['I18N_LOCALE']);
        $project1->setBody('Test projekt 1. PL');
        $project1->setCurrentLocale($_ENV['I18N_FALLBACK_LOCALE']);
        $project1->setBody('Test projekt 1. EN');
        $manager->persist($project1);

        $project2 = (new Project())
            ->setTitle('Projekt 2')
            ->setSlug('project-2')
            ->setYear('2010');
        $project2->setCurrentLocale($_ENV['I18N_LOCALE']);
        $project2->setBody('Test projekt 2. PL');
        $project2->setCurrentLocale($_ENV['I18N_FALLBACK_LOCALE']);
        $project2->setBody('Test projekt 2. EN');
        $manager->persist($project2);

        $project3 = (new Project())
            ->setTitle('Projekt 3')
            ->setSlug('project-3')
            ->setYear('2025');
        $project3->setCurrentLocale($_ENV['I18N_LOCALE']);
        $project3->setBody('Test projekt 3. PL');
        $project3->setCurrentLocale($_ENV['I18N_FALLBACK_LOCALE']);
        $project3->setBody('Test projekt 3. EN');
        $manager->persist($project3);

        $manager->flush();
    }
}
