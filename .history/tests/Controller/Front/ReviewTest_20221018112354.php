<?php

namespace App\Tests\Controller\Front;

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
        $crawler = $client->request('GET', '/movie/1/review/add');

        // On doit avoir une redirection (status code 302)
        $this->assertResponseStatusCodeSame(302);
    }

    public function testAddReview(): void
    {
        $client = static::createClient();

        $client->request('GET', '/movie/1/review/add');
        $client->submitForm('Ajouter', [
            'reviewtype[username]' => 'Nabila',
            'reviewtype[content]' => 'Un joli commentaire pour fainre mon test fonctionnel.',
            'reviewtype[email]' => 'me@automat.fr',
            'reviewtype[rating]' => 4,
            'reviewtype[reactions]' => "smile",
            'reviewtype[watchedAt]' => "2022-10-08 00:00:00",
        ]);
        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists('h3:contains("Commentaires")');
    }
}
