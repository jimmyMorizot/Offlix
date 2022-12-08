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

        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        dd($content);
        // $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}