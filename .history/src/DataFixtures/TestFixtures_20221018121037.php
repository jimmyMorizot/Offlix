<?php

namespace App\DataFixtures;

use App\Entity\Genre;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($g = 1; $g <= 10; $g++) {

            $genre = new Genre();
            $genre->setName('Genre' . $g);

            $manager->persist($genre);
        }

        $manager->flush();
    }
}
