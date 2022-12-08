<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        dump('Maintenance subscriber appelé');

        // pas d'écouteur sur la route _wdt
        // pas d'écouteur sur la route _profiler

        $content = $event->getOutputContent();
		$out = $content->getContent();

        // on injecte le HTML au bon endroit
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
