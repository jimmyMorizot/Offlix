<?php
namespace App\Controller\Front;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController{

    /**
     * display the home
     * 
     * @return Response
     * 
     * @Route("/", name="main_home")
     */
    public function home(ManagerRegistry $doctrine, Request $request, MovieRepository $movieRepo) :Response
    {
        // on définit le nombre éléments par page
        $limit = 10;

        $page = (int)$request->query->get("page", 1);

        $movies = $movieRepo->getPaginatedMovies($page, $limit);

        $total = $

        $movies = $doctrine->getRepository(Movie::class)->findAllOrderByReleaseDate();
        
        return $this->render('front/main/home.html.twig',[
            "movies" => $movies
        ]);
    }
}