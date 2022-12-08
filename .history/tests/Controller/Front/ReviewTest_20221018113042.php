<?php

namespace App\Tests\Controller\Front;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReviewTest extends WebTestCase
{
    /**
     * Anonymous Add Review
     */
    public function testAnonymousReviewAdd(): void
    {
        // On crée un client
        $client = static::createClient();
        // On exécute une requête HTTP en GET sur l'URL /film-1
        $crawler = $client->request('GET', '/review/add/movie/1');

        // On doit avoir une redirection (status code 302)
        $this->assertResponseStatusCodeSame(302);
    }

    public function testAddReview(): void
    {
        $client = static::createClient();

        $client->request('GET', '/review/add/movie/1');

        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère admin@admin.com
        $testUser = $userRepository->findOneByEmail('user@user.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // accède-t-on bien à la page ?
        $this->assertResponseStatusCodeSame(200);

        $client->submitForm('Ajouter', [
            'reviewtype[username]' => 'Nabila',
            'reviewtype[content]' => 'Un joli commentaire pour fainre mon test fonctionnel.',
            'reviewtype[email]' => 'me@automat.fr',
            'reviewtype[rating]' => 4,
            'reviewtype[reactions]' => "smile",
            'reviewtype[watchedAt]' => "2022-10-08 00:00:00",
        ]);

        // Le form nous a redirigé après succès
        $this->assertResponseRedirects();

        // on suit la redirection (on va vers la page en question)
        $client->followRedirect();

        // on s'assure qu'on est sur une page film
        $this->assertSelectorExists('h3:contains("Commentaires")');
    }
}
