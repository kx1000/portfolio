<?php

namespace App\Command;

use App\Factory\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * php bin/console app:add:user email password
 */
class AddUserCommand extends Command
{
    protected static $defaultName = 'app:add:user';

    private $validator;
    private $userFactory;
    private $entityManager;

    public function __construct(
        ValidatorInterface $validator,
        UserFactory $userFactory,
        EntityManagerInterface $entityManager,
        string $name = null
    ) {
        $this->validator = $validator;
        $this->userFactory = $userFactory;
        $this->entityManager = $entityManager;

        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('email', InputArgument::REQUIRED)
            ->addArgument('password', InputArgument::REQUIRED)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = $this->userFactory->createUser($email, $password);

        $errors = $this->validator->validate($user);

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                $io->error($error->getPropertyPath() . ': ' .$error->getMessage());
            }

            return 0;
        }

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $io->success('Utworzono użytkownika :)');

        return 0;
    }
}
