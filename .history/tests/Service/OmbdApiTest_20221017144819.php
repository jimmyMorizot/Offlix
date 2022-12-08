<?php

namespace App\Tests\Service;

use App\Service\OmdbApi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OmbdApiTest extends KernelTestCase
{
    /**
     * Le service OMDB répond 
     *
     * @return void
     */
    public function testFetch(): void
    {
        $kernel = self::bootKernel();

        $omdbApi = static::getContainer()->get(OmdbApi::class);

        // méthode fetch avec un titre
        $result = $omdbApi->fetch('Rambo');

        // le retour est-il de type tableau ?
        $this->assertIsArray($result);
    }
}
