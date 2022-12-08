<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        

        // si URL du Profiler ou WDT, on sort
        // pas d'écouteur sur la route _wdt
        // pas d'écouteur sur la route _profiler
        // $request->getPathInfo() contient la route
        // / = délimiteur de chaine pour le motif regex
        // \/ = slash échappé pour l'URL
        // | = OU
        if (preg_match('/^\/_(profiler|wdt)/', $event->getRequest()->getPathInfo())) {
            return;
        }

        dump('Maintenance subscriber appelé');
        dump($event->getKernel());
        dump($event->getRequest());

        // on injecte le HTML au bon endroit
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
