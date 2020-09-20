<?php

namespace App\Command;

use App\Factory\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
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
            ->addArgument('email', InputArgument::OPTIONAL)
            ->addArgument('password', InputArgument::OPTIONAL)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $errorIo = $output instanceof ConsoleOutputInterface ? new SymfonyStyle($input, $output->getErrorOutput()) : $io;
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $errorIo->title('Creating a new user');

        if (!$email) {
            $emailQuestion = $this->createEmailQuestion();
            $email = $errorIo->askQuestion($emailQuestion);
        }

        if (!$password) {
            $passwordQuestion = $this->createPasswordQuestion();
            $password = $errorIo->askQuestion($passwordQuestion);
        }

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

        $io->success('User '. $email .' has been created :)');

        return 0;
    }

    private function createEmailQuestion(): Question
    {
        $emailQuestion = new Question('Type in email');

        return $emailQuestion->setValidator(function ($value) {
            if ('' === trim($value)) {
                throw new InvalidArgumentException('An email must not be empty.');
            }

            return $value;
        })->setMaxAttempts(20);
    }

    private function createPasswordQuestion(): Question
    {
        $passwordQuestion = new Question('Type in password');

        return $passwordQuestion->setValidator(function ($value) {
            if ('' === trim($value)) {
                throw new InvalidArgumentException('The password must not be empty.');
            }

            return $value;
        })->setHidden(true)->setMaxAttempts(20);
    }
}
