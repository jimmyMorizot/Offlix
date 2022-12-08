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

    public function fetch(): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.omdbapi.com/?t=Shutter+Island&apikey=83bfb8c6'
        );

        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        
        // $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content;
    }
}