<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Create;



use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Client\Entity\Education\Education;
use App\Domain\Client\Entity\Education\EducationRepositoryInterface;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator;
use App\Domain\Client\Entity\Operator\OperatorRepositoryInterface;
use App\Domain\Flusher;

class Handler
{

    private Flusher $flusher;
    private ClientRepositoryInterface $clientRepository;
    private EducationRepositoryInterface $educationRepository;
    private OperatorRepositoryInterface $operatorRepository;

    public function __construct(
        Flusher $flusher,
        ClientRepositoryInterface $clientRepository,
        EducationRepositoryInterface $educationRepository,
        OperatorRepositoryInterface $operatorRepository
    )
    {
        $this->flusher = $flusher;
        $this->clientRepository = $clientRepository;
        $this->educationRepository = $educationRepository;
        $this->operatorRepository = $operatorRepository;
    }

    public function handle(Command $command): void{
        $operator = $this->operatorRepository->get($command->operator);
        $education = $this->educationRepository->get($command->education);


        $client = new Client(
            $command->first_name,
            $command->last_name,
            new Email($command->email),
            $command->phone,
            $command->consent_personal_data,
            $education,
            $operator
        );

        $this->clientRepository->add($client);

        $this->flusher->flush();


    }
}