<?php

namespace App\Controller\Api;

use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GenreController extends AbstractController
{
    /**
     * @Route("/api/genres", name="app_api_genres_get_collection", methods={"GET"})
     */
    public function getCollection(GenreRepository $genreRepository): JsonResponse
    {
        $genres = $genreRepository->findAll();

        return $this->json($genres, Response::HTTP_OK, [], ['groups' => 'api_genres_get_collection']);
    }

    /**
     * Get Item
     * 
     * @Route("/api/genres/{id}/movies", name="app_api_genres_get_item_get_movies", methods={"GET"})
     */
    public function getItem(Genre $genre = null): JsonResponse
    {
        // 404 ?
        if (null === $genre) {
            throw $this->createNotFoundException('Genre non trouvé');
        }


        return $this->json(
            $genre->getMovies(),
            Response::HTTP_OK,
            [],
            [
                'groups' => 'api_movies_get_collection'
            ]
        );
    }
}
