<?php
namespace App\Controller\Front;

use App\Entity\Movie;
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
    public function home(ManagerRegistry $doctrine, Request $request) :Response{

        // on définit le nombre éléments par page
        $limit =
        $page = (int)$request->query->get("page", 1);

        $movies = $doctrine->getRepository(Movie::class)->findAllOrderByReleaseDate();
        
        return $this->render('front/main/home.html.twig',[
            "movies" => $movies
        ]);
    }
}