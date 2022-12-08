<?php

namespace App\EventListener;

use App\Entity\Movie;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class MovieListener
{
    private $slugger;

    public function __construct()
    {
        
    }
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function prePersist(Movie $movie, LifecycleEventArgs $event): void
    {
        dump($movie->getTitle(). 'pre persist');
    }
}