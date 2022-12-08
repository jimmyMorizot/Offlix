<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Service qui cause à OMDB API
 */
class OmdbApi
{
    /**
     * Notre client
     * @link https://symfony.com/doc/5.4/http_client.html
     * @param HttpClientInterface $client Le client HTTP de Symfony
     */
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Va chercher l'info selon le titre du film donné
     * 
     * @param string $title Le titre du film
     * 
     * @return array Les données du film
     */
    public function fetch(string $title): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.omdbapi.com/',
            [
                'query' => [
                    't' => $title,
                    'apikey' => '83bfb8c6',
                ]
            ]
        );

        // on convertit le JSON de retour en tableau PHP
        $contentArray = $response->toArray();

        return $contentArray;
    }

    /**
     * Renvoie l'URL du poster d'un film donné
     * @param string $title Le titre du film
     * @return string L'URL du poster
     */
    public function fetchPoster(string $title)
    {
        $content = $this->fetch($title);

        // le poster est-il manquant (pas de clé 'Poster')
        if (!array_key_exists('Poster', $content)) {
            return '';
        }

        // le poster est-il indiqué comme 'N/A' (Non Applicable, pas de poster)
        if ($content['Poster'] == 'N/A') {
            return '';
        }

        // on retourne le poster
        return $content['Poster'];
    }
}