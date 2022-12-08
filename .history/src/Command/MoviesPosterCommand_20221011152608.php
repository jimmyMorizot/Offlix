<?php

namespace App\Command;

use App\Repository\MovieRepository;
use App\Service\OmdbApi;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MoviesPosterCommand extends Command
{
    protected static $defaultName = 'app:movies:poster';
    protected static $defaultDescription = 'Get movies posters from omdbapi.com';

    // Nos services
    private $movieRepository;
    private $entityManager;
    private $omdbApi;

    public function __construct(MovieRepository $movieRepository, ManagerRegistry $doctrine, OmdbApi $omdbApi)
    {
        $this->movieRepository = $movieRepository;
        $this->entityManager = $doctrine->getManager();
        $this->omdbApi = $omdbApi;

        // On appelle le constructeur parent
        parent::__construct();
    }
    
    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->info('Mise à jour des posters');

        // Récupérer tous les films (via MovieRepository)
        $movies = $this->movieRepository->findAll();
        // Pour chaque film
        foreach ($movies as $movie) {
            // on va requêter l'API avec le titre du film
            $io->info($movie->getTitle());

            // on va chercher l'URL du poster
            $posterUrl = $this->omdbApi->fetchPoster($movie->getTitle());

            // on met à jour le film
            $movie->setPoster($posterUrl);
        }
        // On flush (via l'entityManager)
        $this->entityManager->flush();

        $io->success('Les posters ont été mis à jour');

        return Command::SUCCESS;
    }
}
