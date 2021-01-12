<?php

namespace App\Tests\unit\Factory;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\UnitTester;
use Codeception\Util\Stub;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * php vendor/bin/codecept run unit Factory/UserFactoryCest
 */
class UserFactoryCest
{
    public function createUser(UnitTester $I)
    {
        $passwordEncoder = Stub::makeEmpty(UserPasswordEncoderInterface::class, [
            'encodePassword' => 'test'
        ]);
        $factory = new UserFactory($passwordEncoder);
        $user = $factory->createUser('test@test.com', 'test');

        $I->assertInstanceOf(User::class, $user);
        $I->assertEquals('test@test.com', $user->getEmail());
        $I->assertNotEmpty($user->getPassword());
    }
}
