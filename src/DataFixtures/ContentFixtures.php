<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
       $this->persistMainPageContents($manager);
       //$this->persistAboutPageContents($manager);
       //$this->persistProjectsPageContents($manager);
       //$this->persistContactPageContents($manager);

        $manager->flush();
    }

    private function persistMainPageContents(ObjectManager $manager): void
    {
        $mainPage = $this->getReference(PageFixtures::REF_MAIN);

        $contentHeader = new Content();
        $contentHeader->setCurrentLocale('pl');
        $contentHeader
            ->setPage($mainPage)
            ->setName('header')
            ->setValue('kacper.tech');
        $manager->persist($contentHeader);

        $contentFooter = new Content();
        $contentFooter->setCurrentLocale('pl');
        $contentFooter
            ->setPage($mainPage)
            ->setName('footer')
            ->setValue('Kacper Rogula 2020');
        $manager->persist($contentFooter);

        $contentPageSource = new Content();
        $contentPageSource->setCurrentLocale('pl');
        $contentPageSource
            ->setPage($mainPage)
            ->setName('pageSource')
            ->setValue('https://bitbucket.org/k1002/portfolio-sf/');
        $manager->persist($contentPageSource);

        $contentPhone = new Content();
        $contentPhone->setCurrentLocale('pl');
        $contentPhone
            ->setPage($mainPage)
            ->setName('phone')
            ->setValue('+48 574 189 841');

        $manager->persist($contentPhone);

        $contentEmail = new Content();
        $contentEmail->setCurrentLocale('pl');
        $contentEmail
            ->setPage($mainPage)
            ->setName('email')
            ->setValue('kacper.rogula@gmail.com');
        $manager->persist($contentEmail);
    }

    private function persistAboutPageContents(ObjectManager $manager): void
    {
        $aboutPage = $this->getReference(PageFixtures::REF_ABOUT);

        $contentTitle = (new Content())
            ->setPage($aboutPage)
            ->setName('title')
            ->setValue('00. O mnie');
        $manager->persist($contentTitle);

        $contentWelcome = (new Content())
            ->setPage($aboutPage)
            ->setName('welcome')
            ->setValue('Cześć 👋');
        $manager->persist($contentWelcome);

        $contentImage = (new Content())
            ->setPage($aboutPage)
            ->setName('image')
            ->setValue('https://picsum.photos/300/300');
        $manager->persist($contentImage);

        $contentDescription = (new Content())
            ->setPage($aboutPage)
            ->setName('description')
            ->setValue('Mój przykładowy opis :)');
        $manager->persist($contentDescription);

        $contentCv = (new Content())
            ->setPage($aboutPage)
            ->setName('cv')
            ->setValue('https://picsum.photos/300/300');
        $manager->persist($contentCv);
    }

    private function persistProjectsPageContents(ObjectManager $manager): void
    {
        $projectsPage = $this->getReference(PageFixtures::REF_PROJECTS);

        $contentTitle = (new Content())
            ->setPage($projectsPage)
            ->setName('title')
            ->setValue('Projekty');
        $manager->persist($contentTitle);

        $contentDescription = (new Content())
            ->setPage($projectsPage)
            ->setName('description')
            ->setValue('Zobacz jakimi projektami programistycznymi zajmowałem się hobbystycznie. 👇');
        $manager->persist($contentDescription);

        $contentGithubLink = (new Content())
            ->setPage($projectsPage)
            ->setName('githubLink')
            ->setValue('https://github.com/kx1000');
        $manager->persist($contentGithubLink);

        $contentGithubName = (new Content())
            ->setPage($projectsPage)
            ->setName('githubName')
            ->setValue('GitHub.com/kx1000');
        $manager->persist($contentGithubName);
    }

    private function persistContactPageContents(ObjectManager $manager): void
    {
        $contactPage = $this->getReference(PageFixtures::REF_CONTACT);

        $contentTitle = (new Content())
            ->setPage($contactPage)
            ->setName('title')
            ->setValue('Kontakt');
        $manager->persist($contentTitle);

        $contentDescription =(new Content())
            ->setPage($contactPage)
            ->setName('description')
            ->setValue('Skontaktuj się ze mną wysyłając wiadomość na adres kacper.rogula@gmail.com lub po prostu skorzystaj z formularza poniżej. 👇😉');
        $manager->persist($contentDescription);

        $contentSentConfirmation = (new Content())
            ->setPage($contactPage)
            ->setName('sentConfirmation')
            ->setValue('Twoja wiadomość została przesłana! 🚀 👏');
        $manager->persist($contentSentConfirmation);
    }

    public function getDependencies(): array
    {
        return [
            PageFixtures::class,
        ];
    }
}
