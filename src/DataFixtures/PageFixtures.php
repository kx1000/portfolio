<?php

namespace App\DataFixtures;

use App\Entity\Content;
use App\Entity\Page;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $mainPage = (new Page())
            ->setName('main')
            ->addContent(
                (new Content())
                    ->setName('header')
                    ->setValue('kacper.tech')
            )
            ->addContent(
                (new Content())
                    ->setName('footer')
                    ->setValue('Kacper Rogula 2020')
            )
            ->addContent(
                (new Content())
                    ->setName('pageSource')
                    ->setValue('https://bitbucket.org/k1002/portfolio-sf/')
            )
            ->addContent(
                (new Content())
                    ->setName('phone')
                    ->setValue('+48 574 189 841')
            )
            ->addContent(
                (new Content())
                    ->setName('email')
                    ->setValue('kacper.rogula@gmail.com')
            )
        ;
        $manager->persist($mainPage);

        $aboutPage = (new Page())
            ->setName('about')
            ->addContent(
                (new Content())
                    ->setName('title')
                    ->setValue('CZEŚĆ 👋')
            )
            ->addContent(
                (new Content())
                    ->setName('image')
                    ->setValue('https://picsum.photos/300/300')
            )
            ->addContent(
                (new Content())
                    ->setName('description')
                    ->setValue('Mój przykładowy opis :)')
            )
            ->addContent(
                (new Content())
                    ->setName('cv')
                    ->setValue('https://picsum.photos/300/300')
            )
        ;
        $manager->persist($aboutPage);

        $projectsPage = (new Page())
            ->setName('projects')
            ->addContent(
                (new Content())
                    ->setName('title')
                    ->setValue('Projekty')
            )
            ->addContent(
                (new Content())
                    ->setName('description')
                    ->setValue('Zobacz jakimi projektami programistycznymi zajmowałem się hobbystycznie. 👇')
            )
        ;
        $manager->persist($projectsPage);

        $contactPage = (new Page())
            ->setName('contact')
            ->addContent(
                (new Content())
                    ->setName('title')
                    ->setValue('Kontakt')
            )
            ->addContent(
                (new Content())
                    ->setName('description')
                    ->setValue('Skontaktuj się ze mną wysyłając wiadomość na adres kacper.rogula@gmail.com lub po prostu skorzystaj z formularza poniżej. 👇😉')
            )
            ->addContent(
                (new Content())
                    ->setName('sentConfirmation')
                    ->setValue('Twoja wiadomość została przesłana! 🚀 👏')
            )
        ;
        $manager->persist($contactPage);

        $manager->flush();
    }
}
