<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class MovieController extends AbstractController
{
    /**
     * Get Collection
     * @Route("/api/movies", name="app_api_movies_get_collection", methods={"GET"})
     */
    public function getCollection(Movie): JsonResponse
    {
        // les données

        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Api/MovieController.php',
        ]);
    }
}
