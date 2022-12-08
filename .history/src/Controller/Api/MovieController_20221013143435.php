<?php

namespace App\Controller\Api;

use App\Repository\MovieRepository;
use Serializable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Annotation\Groups;
class MovieController extends AbstractController
{
    /**
     * Get Collection
     * @Route("/api/movies", name="app_api_movies_get_collection", methods={"GET"})
     */
    public function getCollection(Serializable MovieRepository $movieRepository): JsonResponse
    {
        // les données
        // @todo paginer les résultats
        $movies = $movieRepository->findAll();

        return $this->json($movies);
        
    }
}
