<?php

namespace App\Command;

use App\Service\MySlugger;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MoviesSlugifyCommand extends Command
{
    protected static $defaultName = 'app:movies:slugify';
    protected static $defaultDescription = 'Slugifies movies titles in the database';

    // Nos services
    private $movieRepository;
    private $mySlugger;
    private $entityManager;

    public function __construct(MovieRepository $movieRepository, MySlugger $mySlugger, ManagerRegistry $doctrine)
    {
        $this->movieRepository = $movieRepository;
        $this->mySlugger = $mySlugger;
        $this->entityManager = $doctrine->getManager();

        // On appelle le constructeur parent
        parent::__construct();
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // quelles étapes ?
        // 
        // quels services ?

        $io->success('Tous slugs créés.');

        return Command::SUCCESS;
    }
}
