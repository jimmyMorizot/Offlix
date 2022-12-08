<?php

namespace App\Controller\Front;

use App\Entity\Casting;
use App\Entity\Movie;
use App\Entity\Review;
use App\Service\MySlugger;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Cocur\Slugify\Slugify;

class MovieController extends AbstractController
{
    /**
     * Display the list of the movies
     * 
     * @Route("/movie", name="movie_list")
     */
    public function list(ManagerRegistry $doctrine, Request $request): Response
    {
        // appel au model
        $movies = $doctrine->getRepository(Movie::class)->findAllOrderByTitleSearch($request->get('search'));

        // Appel de la vue
        return $this->render('front/movie/list.html.twig',[
            'movies' => $movies
        ]);
    }

    /**
     * Display one movie 
     * 
     * @param int $id index of the movie
     * 
     * @Route("/movie/{slug}", name="movie_show", requirements={"id"="\d+"})
     */
    public function show(Movie $movie = null, ManagerRegistry $doctrine, MySlugger $slugger): Response
    {
        // S'il n'y a pas de film, une 404 est levé automatiquement par le param converter
        // si on laisse $movie = null on récupère la main
        if ($movie === null ) {
            throw $this->createNotFoundException('Film non trouvé.');
        }
        
        $slugTitle = $slugger->slugMovieTitle($movie);

        $entityManager = $doctrine->getManager();

        $castingList = $entityManager->getRepository(Casting::class)->findAllJoinedToPersonByMovie($movie);

        // Exemple pour l'order by
        // $castings = $entityManager->getRepository(Casting::class)->findBy(['movie' => $movie],['creditOrder' => 'ASC']);

        // On va chercher les reviews depuis le repository sans la relation $movie->getReviews()
        $reviews = $entityManager->getRepository(Review::class)->findBy(['movie' => $movie]);
      
        return $this->render('front/movie/show.html.twig', [
            "movie" => $movie,
            "castingList" => $castingList,
            "reviews" => $reviews,
        ]);
    }
}
