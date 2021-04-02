<?php

namespace App\DataFixtures;

use App\Entity\Content;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    const REF_MAIN = 'MAIN';
    const REF_ABOUT = 'ABOUT';
    const REF_PROJECTS = 'PROJECTS';
    const REF_CONTACT = 'CONTACT';

    public function load(ObjectManager $manager)
    {
        $mainPage = (new Page())
            ->setName('main');
        $this->addReference(self::REF_MAIN, $mainPage);
        $manager->persist($mainPage);

        $aboutPage = (new Page())
            ->setName('about');
        $this->addReference(self::REF_ABOUT, $aboutPage);
        $manager->persist($aboutPage);

        $projectsPage = (new Page())
            ->setName('projects');
        $this->addReference(self::REF_PROJECTS, $projectsPage);
        $manager->persist($projectsPage);

        $contactPage = (new Page())
            ->setName('contact');
        $this->addReference(self::REF_CONTACT, $contactPage);
        $manager->persist($contactPage);

        $manager->flush();
    }
}
