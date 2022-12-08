<?php

namespace App\Controller\Api;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * Get Collection
     * @Route("/api/movies", name="app_api_movies_get_collection", methods={"GET"})
     */
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        // les données
        // @todo paginer les résultats
        $movies = $movieRepository->findAll();

        return $this->json($movies);
        return $this->json([$movies]);
    }
}
