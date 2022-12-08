<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse($event): void
    {
        dump('Maintenance subscriber appelé')
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'Kernel.response' => 'onKernelResponse',
        ];
    }
}
