<?php

namespace App\Console;

use App\Domain\Flusher;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'client:scoring',
    aliases: ['client:scoring'],
    hidden: false
)]
final class ScoringCommand extends Command
{

    private Flusher $flusher;

    public function __construct(
        Flusher $flusher,

    ) {
        $this->flusher = $flusher;
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {


        return Command::SUCCESS;
    }
}