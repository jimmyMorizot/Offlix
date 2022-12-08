<?php

namespace App\Tests\Controller\Front;

use App\Repository\UserRepository;
use DateTimeImmutable;
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

        // on se connecte
        // Le Repo des Users
        $userRepository = static::getContainer()->get(UserRepository::class);
        // On récupère admin@admin.com
        $testUser = $userRepository->findOneByEmail('user@user.com');
        // simulate $testUser being logged in
        $client->loginUser($testUser);

        // on accède à la page
        $client->request('GET', '/review/add/movie/1');

        // accède-t-on bien à la page ?
        $this->assertResponseStatusCodeSame(200);

        // ici on remplit le form comme si on le faisait à la main (pas de types PHP)
        $client->submitForm('Ajouter', [
            'review[username]' => 'Nabila',
            'review[email]' => 'me@automat.fr',
            'review[content]' => 'Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. Un joli commentaire pour fainre mon test fonctionnel. ',
            'review[rating]' => 4,
            'review[reactions]' => ["smile"],
            // 'review[watchedAt]' => [
            //     'day' => '08',
            //     'month' => '10',
            //     'year' => '2022'
            // ],
        ]);

        // Le form nous a redirigé après succès
        $this->assertResponseRedirects();

        // on suit la redirection (on va vers la page en question)
        $client->followRedirect();

        // on s'assure qu'on est sur une page film
        $this->assertSelectorExists('h3:contains("Commentaires")');
    }
}
