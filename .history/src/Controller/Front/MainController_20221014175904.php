<?php
namespace App\Controller\Front;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class MainController extends AbstractController{

    /**
     * display the home
     * 
     * @return Response
     * 
     * @Route("/", name="main_home")
     */
    public function home(ManagerRegistry $doctrine, PaginatorInterface $paginator, Request $request) :Response
    {
        
        $movies = $doctrine->getRepository(Movie::class)->findAllOrderByReleaseDate();

        $movies = $paginator->paginate(
            $movies,
            $request->query->getInt('page', 1), 3 
    );

        
        return $this->render('front/main/home.html.twig',[
            "movies" => $movies,
            'paginator' => $paginator
        ]);
    }
}