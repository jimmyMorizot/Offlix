<?php

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Entity\Review;
use App\Form\ReviewType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ReviewController extends AbstractController
{
    /**
     * Ajoute une critique sur un film donné
     * 
     * @Route("/review/add/movie/{id}", name="app_review_add_movie", methods={"GET","POST"})
     */
    public function add(Movie $movie, Request $request, ManagerRegistry $doctrine): Response
    {
        // La nouvelle critique
        $review = new Review();
        // On associe le form à cette entité
        $form = $this->createForm(ReviewType::class, $review);

        // Le form inspecte la requête HTTP
        // => l'objet form de Symfo lit les données transmis en POST dans la requête
        // et tente de les associer à l'entité qu'il contient, dans notre cas $review
        $form->handleRequest($request);

        // Form est soumis et valide ?
        if ($form->isSubmitted() && $form->isValid()) {

            // on associe le film à la review
            $review->setMovie($movie);
            //dd($review);
            $entityManager = $doctrine->getManager();
            $entityManager->persist($review);
            $entityManager->flush();

            // on redirige vers la page du film
            return $this->redirectToRoute('movie_show', [
                'id' => $movie->getId()
            ]);
        }

        // Pour rendre un form on utilise soit :
        // render() + $form->createView()
        // renderForm() + $form => retourner une 422 en cas d'erreur, mieux
        return $this->renderForm('front/review/add.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }
}
