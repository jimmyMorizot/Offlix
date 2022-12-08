<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class MaintenanceSubscriber implements EventSubscriberInterface
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        // si on a affaire à une sous-requête
        // utilisée par le Profiler et aussi les messages d'erreurs (Exception)
        if (!$event->isMainRequest()) {
            return;
        }

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

        // Requête XHR/Fetch ? (AJAX)
        if ($event->getRequest()->isXmlHttpRequest()) {
            return;
        }
        
        // dump('Maintenance subscriber appelé');
        // dump($event);

        // on injecte le HTML au bon endroit
        $response = $event->getResponse();
        $content = $response->getContent();
        // on injecte la bannière sous la nav
        $content = str_replace(
            '</nav>',
            '</nav><div class="alert alert-danger mx-3 my-3">Maintenance prévue mardi 20 octobre à 23h00</div>',
            $content
        );
        // on met à jour le contenu de la réponse
        $response->setContent($content);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.response' => 'onKernelResponse',
        ];
    }
}
