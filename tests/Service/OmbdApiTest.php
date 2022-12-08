<?php


namespace App\Tests\Service;


use App\Service\OmdbApi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class OmdbApiTest extends KernelTestCase
{
    /**
     * Le service OMDB répond-t-il avec notre clé ?
     */
    public function testOmdbResponseOk(): void
    {
        $kernel = self::bootKernel();


        $omdbApi = static::getContainer()->get(OmdbApi::class);


        // méthode fetch avec un titre
        $result = $omdbApi->fetch('Rambo');


        // le retour est-il de type tableau ?
        $this->assertIsArray($result);
    }


    /**
     * Le service OMDB a-t-il retourné le bon film ?
     */
    public function testFetchMovie(): void
    {
        $kernel = self::bootKernel();


        $omdbApi = static::getContainer()->get(OmdbApi::class);


        // méthode fetch avec un titre
        $result = $omdbApi->fetch('Rambo');


        // le retour contient la clé "Title" et la valeur "Rambo ?
        $this->assertArrayHasKey('Title', $result);
        $this->assertSame('Rambo', $result['Title']);
    }
}
