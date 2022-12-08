<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\OflixProvider;
use App\Entity\Casting;
use DateTime;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use App\Entity\User;
use App\Service\MySlugger;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\DBAL\Connection;
use Faker;
use Symfony\Component\String\Slugger\SluggerInterface;

class OfflixFixtures extends Fixture
{
    /**
     * Les propriétés qui vont accueillir les services nécessaires à la classe de Fixtures
     */
    private $connection;
    private $slugger;

    /**
     * On récupère les services utiles via le constructeur
     */
    public function __construct(Connection $connection, MySlugger $slugger)
    {
        // On récupère la connexion à la BDD (DBAL ~= PDO)
        // pour exécuter des requêtes manuelles en SQL pur
        $this->connection = $connection;
        $this->slugger = $slugger;
    }

    /**
     * Permet de TRUNCATE les tables et de remettre les AI à 1
     */
    private function truncate()
    {
        // On passe en mode SQL ! On cause avec MySQL
        // Désactivation la vérification des contraintes FK
        $this->connection->executeQuery('SET foreign_key_checks = 0');
        // On tronque
        $this->connection->executeQuery('TRUNCATE TABLE casting');
        $this->connection->executeQuery('TRUNCATE TABLE genre');
        $this->connection->executeQuery('TRUNCATE TABLE movie');
        $this->connection->executeQuery('TRUNCATE TABLE movie_genre');
        $this->connection->executeQuery('TRUNCATE TABLE person');
        $this->connection->executeQuery('TRUNCATE TABLE review');
        $this->connection->executeQuery('TRUNCATE TABLE season');
        $this->connection->executeQuery('TRUNCATE TABLE user');
        // etc.
    }
    
    public function load(ObjectManager $manager): void
    {
        // On TRUNCATE manuellement
        $this->truncate();

        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        // Pour avoir toujours les mêmes données (le même hasard)
        $faker->seed(2021);

        // Notre data Provider
        $oflixProvider = new OflixProvider();
        // On le fournit à Faker
        // @link https://fakerphp.github.io/#faker-internals-understanding-providers
        // => toutes les méthodes publiques de notre classe sont accessibles via Faker
        $faker->addProvider($oflixProvider);

        // Users
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPassword('$2y$13$.PJiDK3kq2C4owW5RW6Z3ukzRc14TJZRPcMfXcCy9AyhhA9OMK3Li');
        $manager->persist($admin);

        $managerUser = new User();
        $managerUser->setEmail('manager@manager.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        $managerUser->setPassword('$2y$13$/U5OgXbXusW7abJveoqeyeTZZBDrq/Lzh8Gt1RXnEDbT2xJqbv3vi');
        // Attention $manager = le Manager de Doctrine :D
        $manager->persist($managerUser);

        $user = new User();
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword('$2y$13$ZqCHV23K0KMWmCxntdDlmOocuxuuSOXeT7nfKy2ZbE2vFC1VS3Q..');
        $manager->persist($user);

        // Genres

        // Tableau pour nos films
        $genresList = [];

        for ($i = 1; $i <= 20; $i++) {

            // Nouveau genre
            $genre = new Genre();
            $genre->setName($faker->unique()->movieGenre());

            // On l'ajoute à la liste pour usage ultérieur
            $genresList[] = $genre;

            // On persiste
            $manager->persist($genre);
        }   

        // Persons

        // Tableau pour nos persons
        $personsList = [];

        for ($i = 1; $i <= 200; $i++) {

            // Nouvelle Person
            $person = new Person();
            $person->setFirstname($faker->firstName());
            $person->setLastname($faker->lastName());

            // On l'ajoute à la liste pour usage ultérieur
            $personsList[] = $person;

            // On persiste
            $manager->persist($person);
        }   
            
        // Movies

        // Tableau pour nos films
        $moviesList = [];

        for ($i = 1; $i <= 20; $i++) { 

            $movie = new Movie();
            $movie->setTitle($faker->unique()->movieTitle());
            // On a une chance sur 2 d'avoir un film
            $movie->setType($faker->randomElement(['Film', 'Série']));
            $movie->setSummary($faker->paragraph(2));
            $movie->setSynopsis($faker->realText(300));
            $movie->setReleaseDate($faker->dateTimeBetween('-100 years'));
            $movie->setDuration($faker->numberBetween(30, 263));
            $movie->setPoster('https://picsum.photos/id/'.mt_rand(1, 100).'/300/450');
            // Nombre à virgule entre 1 et 5
            $movie->setRating($faker->randomFloat(1, 1, 5));

            // On "slugifie" le titre du film, en minuscule
            // => déplacé dans MovieListener

            // Seasons
            // On vérifie si l'entitéeMovie est une série ou pas
            if ($movie->getType() === 'Série') {
                // Si oui on créer une bouble for avec un numéro aléatoire dans la condition pour déterminer le nombre de saisons
                // mt_rand() ne sera exécuté qu'une fois en début de boucle
                for ($j = 1; $j <= mt_rand(3, 8); $j++) {
                    // On créé la nouvelle entitée Season
                    $season = new Season();
                    // On insert le numéro de la saison en cours $j
                    $season->setNumberSeason($j);
                    // On insert un numéro d'épisode aléatoire
                    $season->setNumberEpisodes(mt_rand(6, 24));
                    // Puis on relie notre saison à notre série
                    $season->setMovie($movie);
                    // On persite
                    $manager->persist($season);
                }
            }

            // On ajoute de 1 à 3 films au hasard pour chaque film
            for ($g = 1; $g <= mt_rand(1, 3); $g++) {

                $randomGenre = $genresList[mt_rand(0, count($genresList) - 1)];
                $movie->addGenre($randomGenre);
                
            }

            // Les castings du film

            // Avant de créer les castings
            // on mélange les valeurs du tableau $personsList
            // afin de piocher dedans les index 1, 2, 3, ... et ne pas avoir de doublon
            shuffle($personsList);

            // On ajoute de 3 à 5 castings par films au hasard pour chaque film
            for ($c = 1; $c <= mt_rand(3, 5); $c++) {

                $casting = new Casting();
                // Les propriétés role et creditOrder
                $casting->setRole($faker->name());
                $casting->setCreditOrder($c);

                // Les 2 associations
                // Movie
                $casting->setMovie($movie);
                // Person
                // On pioche les index fixes 1, 2, 3, ...
                $randomPerson = $personsList[$c];
                $casting->setPerson($randomPerson);

                // On persiste
                $manager->persist($casting);
            }

            // On ajoute le film à la liste des films
            $moviesList[] = $movie; // = array_push($moviesList, $movie);

            // On persiste
            $manager->persist($movie);
        }

        $manager->flush();
    }
}