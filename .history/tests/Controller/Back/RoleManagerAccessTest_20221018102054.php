<?php

namespace App\Tests\Controller\Back;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleManagerAccessTest extends WebTestCase
{
    /**
     * Routes en GET pour ROLE_MANAGER
     * List et Show
     * 
     * @dataProvider getUrlsRead
     */
    public function testPageGetIsSuccessful($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère manager@manager.com
        $testUser = $userRepository->findOneByEmail('manager@manager.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // Le ROLE_MANAGER aura un status code 200
        $this->assertResponseStatusCodeSame(200);
    }

    /**
     * Pour afficher les infos (list et show)
     */
    public function getUrlsRead()
    {
        yield ['/back/casting/movie/1'];
        yield ['/back/movie/'];
        yield ['/back/movie/1'];
        yield ['/back/user/'];
        yield ['/back/user/1'];
        // ...
    }

    /**
     * Routes en GET pour ROLE_MANAGER
     * Edit form
     * 
     * @dataProvider getUrlsWrite
     */
    public function testPageGetIsForbidden($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère manager@manager.com
        $testUser = $userRepository->findOneByEmail('manager@manager.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // Le ROLE_MANAGER aura un status code 403
        $this->assertResponseStatusCodeSame(403);
    }

    /**
     * Pour afficher les form edit
     */
    public function getUrlsWrite()
    {
        yield ['/back/casting/new/movie/1'];
        yield ['/back/casting/Colette%20Evrard/1/52/edit'];
        yield ['/back/movie/new'];
        yield ['/back/movie/1/edit'];
        yield ['/back/user/new'];
        yield ['/back/user/1/edit'];
        // ...
    }

    /**
     * Routes en POST pour ROLE_MANAGER
     * 
     * @dataProvider postUrls
     */
    public function testPagePostIsRedirect($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère manager@manager.com
        $testUser = $userRepository->findOneByEmail('manager@manager.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('POST', $url);

        // Le ROLE_MANAGER aura un status code 403
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
