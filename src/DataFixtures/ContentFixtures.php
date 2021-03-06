<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture implements DependentFixtureInterface
{
    const LOCALE_PL = 'pl';
    const LOCALE_EN = 'en';

    public function load(ObjectManager $manager)
    {
       $this->persistMainPageContents($manager);
       $this->persistAboutPageContents($manager);
       $this->persistProjectsPageContents($manager);
       $this->persistContactPageContents($manager);

        $manager->flush();
    }

    private function persistMainPageContents(ObjectManager $manager): void
    {
        $mainPage = $this->getReference(PageFixtures::REF_MAIN);

        $contentHeader = (new Content())
            ->setPage($mainPage)
            ->setName('header');
        $contentHeader->setCurrentLocale(self::LOCALE_PL);
        $contentHeader->setValue('kacper.tech');
        $contentHeader->setCurrentLocale(self::LOCALE_EN);
        $contentHeader->setValue('kacper.tech');
        $manager->persist($contentHeader);

        $contentFooter = (new Content())
            ->setPage($mainPage)
            ->setName('footer');
        $contentFooter->setCurrentLocale(self::LOCALE_PL);
        $contentFooter->setValue('Kacper Rogula 2020');
        $contentFooter->setCurrentLocale(self::LOCALE_EN);
        $contentFooter->setValue('Kacper Rogula 2020');
        $manager->persist($contentFooter);

        $contentPageSource = (new Content())
            ->setPage($mainPage)
            ->setName('pageSource');
        $contentPageSource->setCurrentLocale(self::LOCALE_PL);
        $contentPageSource->setValue('https://github.com/kx1000/portfolio');
        $contentPageSource->setCurrentLocale(self::LOCALE_EN);
        $contentPageSource->setValue('https://github.com/kx1000/portfolio');
        $manager->persist($contentPageSource);

        $contentPhone = (new Content())
            ->setPage($mainPage)
            ->setName('phone');
        $contentPhone->setCurrentLocale(self::LOCALE_PL);
        $contentPhone->setValue('+48 574 189 841');
        $contentPhone->setCurrentLocale(self::LOCALE_EN);
        $contentPhone->setValue('+48 574 189 841');
        $manager->persist($contentPhone);

        $contentEmail = (new Content())
            ->setPage($mainPage)
            ->setName('email');
        $contentEmail->setCurrentLocale(self::LOCALE_PL);
        $contentEmail->setValue('kacper.rogula@gmail.com');
        $contentEmail->setCurrentLocale(self::LOCALE_EN);
        $contentEmail->setValue('kacper.rogula@gmail.com');
        $manager->persist($contentEmail);
    }

    private function persistAboutPageContents(ObjectManager $manager): void
    {
        $aboutPage = $this->getReference(PageFixtures::REF_ABOUT);

        $contentTitle = (new Content())
            ->setPage($aboutPage)
            ->setName('title');
        $contentTitle->setCurrentLocale(self::LOCALE_PL);
        $contentTitle->setValue('00. O mnie');
        $contentTitle->setCurrentLocale(self::LOCALE_EN);
        $contentTitle->setValue('00. About');
        $manager->persist($contentTitle);

        $contentWelcome = (new Content())
            ->setPage($aboutPage)
            ->setName('welcome');
        $contentWelcome->setCurrentLocale(self::LOCALE_PL);
        $contentWelcome->setValue('Cześć 👋');
        $contentWelcome->setCurrentLocale(self::LOCALE_EN);
        $contentWelcome->setValue('Hello 👋');
        $manager->persist($contentWelcome);

        $contentImage = (new Content())
            ->setPage($aboutPage)
            ->setName('image');
        $contentImage->setCurrentLocale(self::LOCALE_PL);
        $contentImage->setValue('https://picsum.photos/300/300');
        $contentImage->setCurrentLocale(self::LOCALE_EN);
        $contentImage->setValue('https://picsum.photos/300/300');
        $manager->persist($contentImage);

        $contentDescription = (new Content())
            ->setPage($aboutPage)
            ->setName('description');
        $contentDescription->setCurrentLocale(self::LOCALE_PL);
        $contentDescription->setValue('Mój przykładowy opis :)');
        $contentDescription->setCurrentLocale(self::LOCALE_EN);
        $contentDescription->setValue('My example description :)');
        $manager->persist($contentDescription);

        $contentCv = (new Content())
            ->setPage($aboutPage)
            ->setName('cv');
        $contentCv->setCurrentLocale(self::LOCALE_PL);
        $contentCv->setValue('https://picsum.photos/300/300');
        $contentCv->setCurrentLocale(self::LOCALE_EN);
        $contentCv->setValue('https://picsum.photos/300/300');
        $manager->persist($contentCv);
    }

    private function persistProjectsPageContents(ObjectManager $manager): void
    {
        $projectsPage = $this->getReference(PageFixtures::REF_PROJECTS);

        $contentTitle = (new Content())
            ->setPage($projectsPage)
            ->setName('title');
        $contentTitle->setCurrentLocale(self::LOCALE_PL);
        $contentTitle->setValue('01. Projekty');
        $contentTitle->setCurrentLocale(self::LOCALE_EN);
        $contentTitle->setValue('01. Projects');
        $manager->persist($contentTitle);

        $contentDescription = (new Content())
            ->setPage($projectsPage)
            ->setName('description');
        $contentDescription->setCurrentLocale(self::LOCALE_PL);
        $contentDescription->setValue('Zobacz jakimi projektami programistycznymi zajmowałem się hobbystycznie. 👇');
        $contentDescription->setCurrentLocale(self::LOCALE_EN);
        $contentDescription->setValue('See what programming projects I have made as a hobby. 👇');
        $manager->persist($contentDescription);

        $contentGithubLink = (new Content())
            ->setPage($projectsPage)
            ->setName('githubLink');
        $contentGithubLink->setCurrentLocale(self::LOCALE_PL);
        $contentGithubLink->setValue('https://github.com/kx1000');
        $contentGithubLink->setCurrentLocale(self::LOCALE_EN);
        $contentGithubLink->setValue('https://github.com/kx1000');
        $manager->persist($contentGithubLink);

        $contentGithubName = (new Content())
            ->setPage($projectsPage)
            ->setName('githubName');
        $contentGithubName->setCurrentLocale(self::LOCALE_PL);
        $contentGithubName->setValue('GitHub.com/kx1000');
        $contentGithubName->setCurrentLocale(self::LOCALE_EN);
        $contentGithubName->setValue('GitHub.com/kx1000');
        $manager->persist($contentGithubName);
    }

    private function persistContactPageContents(ObjectManager $manager): void
    {
        $contactPage = $this->getReference(PageFixtures::REF_CONTACT);

        $contentTitle = (new Content())
            ->setPage($contactPage)
            ->setName('title');
        $contentTitle->setCurrentLocale(self::LOCALE_PL);
        $contentTitle->setValue('02. Kontakt');
        $contentTitle->setCurrentLocale(self::LOCALE_EN);
        $contentTitle->setValue('02. Contact');
        $manager->persist($contentTitle);

        $contentDescription = (new Content())
            ->setPage($contactPage)
            ->setName('description');
        $contentDescription->setCurrentLocale(self::LOCALE_PL);
        $contentDescription
            ->setValue('Skontaktuj się ze mną wysyłając wiadomość na adres kacper.rogula@gmail.com lub po prostu skorzystaj z formularza poniżej. 👇😉');
        $contentDescription->setCurrentLocale(self::LOCALE_EN);
        $contentDescription
            ->setValue('Contact me by sending a message to kacper.rogula@gmail.com or just use the form below. 👇😉 ');
        $manager->persist($contentDescription);

        $contentSentConfirmation = (new Content())
            ->setPage($contactPage)
            ->setName('sentConfirmation');
        $contentSentConfirmation->setCurrentLocale(self::LOCALE_PL);
        $contentSentConfirmation->setValue('Twoja wiadomość została przesłana! 🚀 👏');
        $contentSentConfirmation->setCurrentLocale(self::LOCALE_EN);
        $contentSentConfirmation->setValue('Your message has been sent! 🚀 👏');
        $manager->persist($contentSentConfirmation);
    }

    public function getDependencies(): array
    {
        return [
            PageFixtures::class,
        ];
    }
}
