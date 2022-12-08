<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GenreController extends AbstractController
{
    /**
     * Display the list of the gender
     * 
     * @Route("/genre", name="movie_list")
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
}
