<?php

namespace App\EventListener;

use App\Entity\Movie;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class MovieListener
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postUpdate(Movie $movie, LifecycleEventArgs $event): void
    {
        // ... do something to notify the changes
    }
}