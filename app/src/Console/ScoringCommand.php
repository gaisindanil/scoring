<?php

namespace App\Console;

use App\Domain\Client\Entity\Client;
use App\Domain\Client\Entity\ClientRepositoryInterface;
use App\Domain\Client\Services\ScoringServices;
use App\Domain\Flusher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:client:scoring',
    hidden: false
)]
final class ScoringCommand extends Command
{
    private Flusher $flusher;
    private ClientRepositoryInterface $clientRepository;
    private ScoringServices $scoringServices;

    public function __construct(
        Flusher                   $flusher,
        ClientRepositoryInterface $clientRepository,
        ScoringServices           $scoringServices
    )
    {
        $this->flusher = $flusher;
        $this->clientRepository = $clientRepository;
        $this->scoringServices = $scoringServices;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addArgument('id', InputArgument::OPTIONAL, 'The id of the client.');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            /** @var int $id */
            if ($id = null !== $input->getArgument('id')) {
                $findAllClients = $this->clientRepository->get($id);
            } else {
                $findAllClients = $this->clientRepository->all();
            }


                /** @var Client $client */
                foreach ($findAllClients as $client) {
                    $scope = $this->scoringServices->calculation($client);
                    $output->writeln($client->getFirstName() . ' ' . $client->getLastName() . ' - оценка: ' . $scope);
                    $client->saveScoring($scope);
                }


                $this->flusher->flush();


            return Command::SUCCESS;
        } catch (\Exception $exception) {
            $output->writeln($exception->getMessage());

            return Command::FAILURE;
        }
    }
}
