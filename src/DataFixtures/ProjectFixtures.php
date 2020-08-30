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
            ->setBody('Test projekt 1.')
            ->addLink(
                (new Link())
                    ->setIcon('fab amazon')
                    ->setTitle('amazon')
                    ->setUrl('https://amazon.com')
            )
            ->addTechnology(
                (new Technology())
                    ->setName('PHP')
            )
            ;
        $manager->persist($project1);

        $project2 = (new Project())
            ->setTitle('Projekt 2')
            ->setSlug('project-2')
            ->setBody('Test projekt 2.')
        ;
        $manager->persist($project2);

        $project3 = (new Project())
            ->setTitle('Projekt 3')
            ->setSlug('project-3')
            ->setBody('Test projekt 3.')
        ;
        $manager->persist($project3);

        $manager->flush();
    }
}
