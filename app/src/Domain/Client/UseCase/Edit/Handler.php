<?php

declare(strict_types=1);

namespace App\Domain\Client\UseCase\Edit;

use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Client\Entity\ConsentPersonalData;
use App\Domain\Client\Entity\Education\EducationRepositoryInterface;
use App\Domain\Client\Entity\Email;
use App\Domain\Client\Entity\Operator\OperatorRepositoryInterface;
use App\Domain\Client\Services\ScoringServices;
use App\Domain\Flusher;

class Handler
{
    private Flusher $flusher;
    private ClientRepositoryInterface $clientRepository;
    private EducationRepositoryInterface $educationRepository;
    private OperatorRepositoryInterface $operatorRepository;
    private ScoringServices $scoringServices;

    public function __construct(
        Flusher $flusher,
        ClientRepositoryInterface $clientRepository,
        EducationRepositoryInterface $educationRepository,
        OperatorRepositoryInterface $operatorRepository,
        ScoringServices $scoringServices
    ) {
        $this->flusher = $flusher;
        $this->clientRepository = $clientRepository;
        $this->educationRepository = $educationRepository;
        $this->operatorRepository = $operatorRepository;
        $this->scoringServices = $scoringServices;
    }

    public function handle(Command $command): void
    {
        $client = $this->clientRepository->get($command->id);

        $operator = $this->operatorRepository->get($command->operator);
        $education = $this->educationRepository->get($command->education);

        $client->edit(
            $command->first_name,
            $command->last_name,
            new Email($command->email),
            $operator,
            $command->phone,
            new ConsentPersonalData($command->consent_personal_data),
            $education
        );

        $client->saveScoring($this->scoringServices->calculation($client));

        $this->flusher->flush();
    }
}
