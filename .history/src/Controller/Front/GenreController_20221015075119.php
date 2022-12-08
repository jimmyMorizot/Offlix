<?php

namespace App\Controller;

use App\Entity\Genre;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    /**
     * Display the list of the gender
     * 
     * @Route("/genre", name="genre_list")
     */
    public function list(ManagerRegistry $doctrine, Request $request): Response
    {
        
        // appel au model
        $genres = $doctrine->getRepository(Genre::class)->findAllOrderByNameSearch($request->get('search'));

        // Appel de la vue
        return $this->render('front/movie/list.html.twig',[
            'genres' => $genres
        ]);
    }
}
