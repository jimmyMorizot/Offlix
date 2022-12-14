<?php

namespace App\Command;


use App\Repository\MovieRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MoviesPosterCommand extends Command
{
    protected static $defaultName = 'app:movies:poster';
    protected static $defaultDescription = 'Add a short description for your command';

    // Nos services
    private $movieRepository;
    private $mySlugger;
    private $entityManager;

    public function __construct(MovieRepository $movieRepository, ManagerRegistry $doctrine)
    {
        $this->movieRepository = $movieRepository;
        $this->mySlugger = $mySlugger;
        $this->entityManager = $doctrine->getManager();

        // On appelle le constructeur parent
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
