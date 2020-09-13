<?php

namespace App\DataFixtures;

use App\Entity\Content;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $abooutContent = (new Content())
            ->setName('about')
            ->setTitle('CZEŚĆ 👋')
            ->setValue('Przykładowy tekst')
            ;
        $manager->persist($abooutContent);

        $sentContent = (new Content())
            ->setName('sent')
            ->setTitle(' Wysłano wiadomość')
            ->setValue('Twoja wiadomość została przesłana! 🚀 👏')
        ;
        $manager->persist($sentContent);

        $projectsContent = (new Content())
            ->setName('projects')
            ->setTitle('Projekty')
            ->setValue('Zobacz jakimi projektami programistycznymi zajmowałem się hobbystycznie. 👇')
        ;
        $manager->persist($projectsContent);

        $contactContent = (new Content())
            ->setName('contact')
            ->setTitle('Kontakt')
            ->setValue('Skontaktuj się ze mną wysyłając wiadomość na adres kacper.rogula@gmail.com lub po prostu skorzystaj z formularza poniżej. 👇😉')
        ;
        $manager->persist($contactContent);

        $footerContent = (new Content())
            ->setName('footer')
            ->setTitle('Kacper Rogula 2020')
            ->setValue('<a href="https://bitbucket.org/k1002/portfolio-sf/" target="_blank">źródło strony</a>')
        ;
        $manager->persist($footerContent);

        $headerContent = (new Content())
            ->setName('header')
            ->setTitle('Kacper Rogula')
        ;
        $manager->persist($headerContent);

        $manager->flush();
    }
}
