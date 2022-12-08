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

        $populator = new Populator($faker,$manager);

        //!Movie
        $populator->addEntity(Movie::class,6,[
            'title' => function() use ($faker) { return $faker->unique()->movie(); },
            'duration' => function() use ($faker) { return $faker->numberBetween(60,240); },
            'rating' => function() use ($faker) { return $faker->randomFloat(1,0,5); },
            'type' => function() { 
                
                $type = rand(0,1) ? "Série" : "Film";
                return $type;
             },
             'poster' => function()  { return "https://picsum.photos/200/300"; },
             'slug' => function(slugMovieTitle()) {
                
             }
             
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
         $populator->addEntity(Genre::class,15,[
            'name' => function() use ($faker) { return $faker->unique()->genre(); },
         ]);

        //  for ($i = 0; $i < 20; $i++) {

        //     $genre = new Genre();
        //     $genre->setName("genre #$i");

        //     $manager->persist($genre);
        // }

         //!Person
         $populator->addEntity(Person::class,8);

        //  for ($i = 0; $i < 20; $i++) {

        //     $person = new Person();
        //     $person->setFirstname("first #$i");
        //     $person->setLastname("last #$i");

        //     $manager->persist($person);
        // }

        //!Casting
        $populator->addEntity(Casting::class,10,[
            'role' => function() use ($faker) { return $faker->name(); },
            'creditOrder' => function() use ($faker) { return $faker->numberBetween(0,120); },
        ]);


        //!Season
        $populator->addEntity(Season::class,10,[
            'numberSeason' => function() use ($faker) { return $faker->unique()->numberBetween(1,15); },
            'numberEpisodes' => function() use ($faker) { return $faker->numberBetween(5,23); },
        ]);

        //!Movie_genre

        // Ici j'ai un tableau avec tous mes objets ajouté en bdd
        $insertedItems = $populator->execute();

        // Je créer un tableau vide
        $movies = [];
        // Je mets mes objets films dans mon tableau de films
        foreach($insertedItems['App\Entity\Movie'] as $movie){
            $movie->__construct();
            $movies[] = $movie;
        }
        // Je foreach sur les genre et j'ajoute les films à l'aide de mon tableau de film
        foreach($insertedItems['App\Entity\Genre'] as $genre){
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
