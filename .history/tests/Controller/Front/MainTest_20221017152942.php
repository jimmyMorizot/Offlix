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

        $this->assertResponse();
        $this->assertSelectorTextContains('h1', 'Hello World');
    }
}
