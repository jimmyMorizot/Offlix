<?php

namespace App\Tests\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainTest extends WebTestCase
{
    public function testHome(): void
    {
        // on crée un client HTTP
        $client = static::createClient();

        // on émet une requête HTTP
        $crawler = $client->request('GET', '/');

        // status code 200
        $this->assertResponseStatusCodeSame(200);

        // est-on sur la bonne page ?
        $this->assertSelectorTextContains('h1', 'Films', 'séries' TV et popcorn en illimité);
    }
}
