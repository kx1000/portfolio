<?php


namespace App\Factory;


use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFactory
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->passwordEncoder = $userPasswordEncoder;
    }

    public function createUser(string $email, string $plainPassword): User
    {
        $user = (new User())
            ->setEmail($email);

        $user->setPassword(
            $this->passwordEncoder
                ->encodePassword($user, $plainPassword)
        );

        return $user;
    }
}