<?php

namespace App\DataFixtures;

use App\DataFixtures\Provider\AppProvider;
use App\Entity\Casting;
use App\Entity\Genre;
use App\Entity\Movie;
use App\Entity\Person;
use App\Entity\Season;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Faker\ORM\Doctrine\Populator;

class OfflixFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // ! config du faker et du populator
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new AppProvider());

        $populator = new Populator($faker, $manager);

        //!Movie
        $populator->addEntity(Movie::class, 6, [
            'title' => function () use ($faker) {
                return $faker->unique()->movie();
            },
            'duration' => function () use ($faker) {
                return $faker->numberBetween(60, 240);
            },
            'rating' => function () use ($faker) {
                return $faker->randomFloat(1, 0, 5);
            },
            'type' => function () {

                $type = rand(0, 1) ? "Série" : "Film";
                return $type;
            },
            'poster' => function () {
                return "https://picsum.photos/200/300";
            },
        ]);
        // for ($i = 0; $i < 20; $i++) {

        //     $movie = new Movie();
        //     $movie->setTitle("Movie #$i");
        //     $movie->setReleaseDate(new DateTimeImmutable());
        //     $movie->setSummary($faker->sentence(20));
        //     $movie->setSynopsis("Mon résumé beaucou plus long #$i");
        //     $movie->setPoster("image$i.jpg");
        //     $movie->setDuration($i);
        //     $movie->setType("Film");
        //     $movie->setRating(mt_rand(0,5));

        //     $manager->persist($movie);
        // }

        //!Genre
        $populator->addEntity(Genre::class, 15, [
            'name' => function () use ($faker) {
                return $faker->unique()->genre();
            },
        ]);

        //  for ($i = 0; $i < 20; $i++) {

        //     $genre = new Genre();
        //     $genre->setName("genre #$i");

        //     $manager->persist($genre);
        // }

        //!Person
        $populator->addEntity(Person::class, 8);

        //  for ($i = 0; $i < 20; $i++) {

        //     $person = new Person();
        //     $person->setFirstname("first #$i");
        //     $person->setLastname("last #$i");

        //     $manager->persist($person);
        // }

        //!Casting
        $populator->addEntity(Casting::class, 10, [
            'role' => function () use ($faker) {
                return $faker->name();
            },
            'creditOrder' => function () use ($faker) {
                return $faker->numberBetween(0, 120);
            },
        ]);


        //!Season
        $populator->addEntity(Season::class, 10, [
            'numberSeason' => function () use ($faker) {
                return $faker->unique()->numberBetween(1, 15);
            },
            'numberEpisodes' => function () use ($faker) {
                return $faker->numberBetween(5, 23);
            },
        ]);

        //!Movie_genre

        // Ici j'ai un tableau avec tous mes objets ajouté en bdd
        $insertedItems = $populator->execute();

        // Je créer un tableau vide
        $movies = [];
        // Je mets mes objets films dans mon tableau de films
        foreach ($insertedItems['App\Entity\Movie'] as $movie) {
            $movie->__construct();
            $movies[] = $movie;
        }
        // Je foreach sur les genre et j'ajoute les films à l'aide de mon tableau de film
        foreach ($insertedItems['App\Entity\Genre'] as $genre) {
            $genre->__construct();
            // On récupère un index de film au hasard
            $rand = array_rand($movies);
            // On rajoute un film à un genre à l'aide de addMovie()
            $genre->addMovie($movies[$rand]);
        }
        // on oublie de flush
        $manager->flush();
    }
}









/*class OfflixFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->seed(1234);
        
        // Créer 10 films fakés
        for ($i=1; $i <= 10; $i++) { 
            $movie = new Movie();

            $movie->setTitle($faker->sentence(2));
            $movie->setSummary($faker->paragraph());
            $movie->setSynopsis($faker->text());
            $movie->setPoster($faker->imageUrl(480, 640));
            $movie->setReleaseDate($faker->dateTimeBetween('-1 years'));
            $movie->setDuration($faker->numberBetween(60, 180));
            $movie->setType($faker->jobTitle('Série', 'Film'));
            $movie->setRating($faker->randomFloat(1, 0, 5));
            
            $manager->persist($movie);


            // Créer entre 4 et 6 genres
            for ($j = 1; $j <= mt_rand(4, 6); $j++) { 

                $genre = new Genre();

                $genre->setName($faker->jobTitle());

                $manager->persist($genre);


                // Créer entre 4 et 10 personnes
                for ($k=1; $k <= mt_rand(4, 10) ; $k++) { 
                    $person = new Person();

                    $person->setFirstname($faker->firstName());
                    $person->setLastname($faker->lastName());

                    $manager->persist($person);
                }
                 // Créer entre 4 et 6 casting 
                 for ($l=1; $l <= mt_rand(2, 3); $l++) { 
                    $casting = new Casting();

                    $casting->setRole($faker->sentence());
                    $casting->setCreditOrder($faker->randomDigitNotNull());
                    $casting->setMovie($movie);
                    $casting->setPerson($person);

                    $manager->persist($casting);
                }
                 // Créer entre 4 et 6 saisons
                 for ($m=1; $m <= 2 ; $m++) { 
                    $season = new Season();

                    $season->setNumberEpisodes($faker->randomDigitNotNull());
                    $season->setNumberSeason($faker->numberBetween(1, 3));
                    $season->setReleaseDate($faker->dateTimeBetween('-1 years'));
                    $season->setMovie($movie);

                    $manager->persist($season);
                }
            }
        }

        $manager->flush();
    }
}*/
