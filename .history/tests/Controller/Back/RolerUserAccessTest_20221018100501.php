<?php

namespace App\Tests\Controller\Back;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleUserAccessTest extends WebTestCase
{
    /**
     * Routes en GET pour ROLE_USER
     * 
     * @dataProvider getUrls
     */
    public function testPageGetIsRedirect($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère user@user.com
        $testUser = $userRepository->findOneByEmail('user@user.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // Le ROLE_USER aura un status code 403
        $this->assertResponseStatusCodeSame(403);
    }

    public function getUrls()
    {
        yield ['/back/casting/movie/1'];
        yield ['/back/casting/new/movie/1'];
        yield ['/back/casting/Colette%20Evrard/1/52/edit'];
        yield ['/back/movie/'];
        yield ['/back/movie/new'];
        yield ['/back/movie/1'];
        yield ['/back/movie/1/edit'];
        yield ['/back/user/'];
        yield ['/back/user/new'];
        yield ['/back/user/1'];
        yield ['/back/user/1/edit'];
        // ...
    }

    /**
     * Routes en POST pour ROLE_USER
     * 
     * @dataProvider postUrls
     */
    public function testPagePostIsRedirect($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère user@user.com
        $testUser = $userRepository->findOneByEmail('user@user.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('POST', $url);

        // Le ROLE_USER aura un status code 403
        $this->assertResponseStatusCodeSame(403);
    }

    public function postUrls()
    {
        yield ['/back/casting/new/movie/1'];
        yield ['/back/casting/Colette%20Evrard/1/52/edit'];
        yield ['/back/casting/Colette%20Evrard/1/52/edit'];
        yield ['/back/movie/new'];
        yield ['/back/movie/1/edit'];
        yield ['/back/movie/1'];
        yield ['/back/user/new'];
        yield ['/back/user/1/edit'];
        yield ['/back/user/1'];
        // ...
    }
}
