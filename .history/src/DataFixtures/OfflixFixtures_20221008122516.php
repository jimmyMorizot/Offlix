<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use App\Entity\Casting;
use Faker\ORM\Doctrine\Populator;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\Provider\AppProvider;
use App\Service\MySlugger;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class OfflixFixtures extends Fixture
{
    private $slugger;

    public function __construct(MySlugger $slugger)
    {
        $this->slugger = $slugger;
    }

   

    public function load(ObjectManager $manager): void
    {
        // ! config du faker et du populator
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new AppProvider());

        // Pour avoir toujours les mêmes données (le même hasard)
        $faker->seed(2022);

        // Nos users
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $admin->setRoles(['ROLE_ADMIN']);
        // bin/console security:hash-password => admin
        $admin->setPassword('$2y$13$/LRHx9AA56jotW5UV40BjeB1N5NU4zkMyD34lOv8Lb8ozBDVpbh2u');

        // /!\ la variable $manager est déjà existante en paramètre de la méthode load() !
        $managerUser = new User();
        $managerUser->setEmail('manager@manager.com');
        $managerUser->setRoles(['ROLE_MANAGER']);
        // bin/console security:hash-password => manager
        $managerUser->setPassword('$2y$13$A30us9hMs04OMDrp387iiOzgpyN1RxWhQNE3DcFwsNhN9O0DYugdW');

        $user = new User();
        $user->setEmail('user@user.com');
        $user->setRoles(['ROLE_USER']);
        // bin/console security:hash-password => user
        $user->setPassword('$2y$13$OX9RoBNejyEYZaMx9JmR8Ogw5AIDWPRSmrwmf8To9fv6CuiFa4r2C');

        $manager->persist($admin);
        $manager->persist($managerUser);
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
            $populator = new Populator($faker,$manager);

            

            // On ajoute le film à la liste des films
            $moviesList[] = $movie; // = array_push($moviesList, $movie);

            // On persiste
            $manager->persist($movie);
        }

        $manager->flush();
    }
}
