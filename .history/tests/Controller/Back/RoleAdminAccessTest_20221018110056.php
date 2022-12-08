<?php

namespace App\Tests\Controller\Back;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RoleAdminAccessTest extends WebTestCase
{
    /**
     * Routes en GET pour ROLE_ADMIN
     * 
     * @dataProvider getUrls
     */
    public function testPageGetIsSuccessful($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère admin@admin.com
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // Le ROLE_ADMIN aura un status code 200
        $this->assertResponseStatusCodeSame(200);
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
     * Routes pour "new" pour ROLE_ADMIN
     * 
     * @dataProvider postUrlsNew
     */
    public function testPagePostIsUnprocessable($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère admin@admin.com
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // On affiche le form
        $this->assertResponseStatusCodeSame(200);

        // On soumet le form vide
        $crawler = $client->submitForm('Save');

        // Le ROLE_ADMIN aura un status code 422
        $this->assertResponseStatusCodeSame(422);
        // ou $this->assertResponseIsUnprocessable();
    }

    public function postUrlsNew()
    {
        yield ['/back/casting/new/movie/1'];
        yield ['/back/movie/new'];
        yield ['/back/user/new'];
        // ...
    }

    /**
     * Routes pour "edit" et "delete" pour ROLE_ADMIN
     * 
     * @dataProvider postUrlsEditDelete
     */
    public function testPagePostIsSeeOther($url)
    {
        // On crée un client
        $client = static::createClient();

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère admin@admin.com
        $testUser = $userRepository->findOneByEmail('admin@admin.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // On exécute la requête APRES être loggué
        $client->request('GET', $url);

        // On affiche le form
        $this->assertResponseStatusCodeSame(200);

        // On soumet le form vide
        $crawler = $client->submitForm('Update');

        // Le ROLE_ADMIN aura un status code 303
        $this->assertResponseStatusCodeSame(303);
        // ou $this->assertResponseRedirects();
    }

    public function postUrlsEditDelete()
    {
        yield ['/back/casting/Colette%20Evrard/1/52/edit'];
        // yield ['/back/casting/1'];
        yield ['/back/movie/1/edit'];
        // yield ['/back/movie/1'];
        yield ['/back/user/1/edit'];
        // yield ['/back/user/1'];
        // ...
    }

    /**
     * Idem pour DELETE mais Bouton = "Supprimer"
     */
}
