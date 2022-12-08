<?php

namespace App\EventListener;

use Doctrine\Persistence\Event\LifecycleEventArgs;

class UserChangedNotifier
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function postUpdate(User $user, LifecycleEventArgs $event): void
    {
        // ... do something to notify the changes
    }
}