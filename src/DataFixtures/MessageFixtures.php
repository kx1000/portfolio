<?php

namespace App\DataFixtures;

use App\Entity\Message;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MessageFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $message = (new Message())
            ->setEmail('test@test.com')
            ->setTitle('title fixtures')
            ->setBody('body fixtures')
            ;
        $manager->persist($message);

        $manager->flush();
    }
}
