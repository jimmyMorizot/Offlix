<?php

namespace App\Tests\Service;

use App\Service\OmdbApi;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OmbdApiTest extends KernelTestCase
{
    public function testFetch(): void
    {
        $kernel = self::bootKernel();

        $omdbApi = static::getContainer()->get(OmdbApi::class);

        // méthode fetch avec un titre
        $result = $omdbApi
    }
}
