<?php

declare(strict_types=1);

namespace App\Domain\User\UseCase\Signup;



use App\Domain\Flusher;
use App\Domain\User\Entity\Education;
use App\Domain\User\Entity\Email;
use App\Domain\User\Entity\Operator;
use App\Domain\User\Entity\User;
use App\Domain\User\Entity\UserRepositoryInterface;

class Handler
{

    private Flusher $flusher;
    private UserRepositoryInterface $userRepository;
    public function __construct(Flusher $flusher, UserRepositoryInterface $userRepository)
    {
        $this->flusher = $flusher;
        $this->userRepository = $userRepository;
    }

    public function handle(Command $command): void{
        $user = new User(
            $command->first_name,
            $command->last_name,
            new Email($command->email),
            new Operator($command->operator),
            $command->phone,
            $command->consentPersonalData,
            new Education($command->education)

        );

        $this->userRepository->add($user);


    }
}