<?php

namespace App\Controller\Api;

use Serializable;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;

class MovieController extends AbstractController
{
    /**
     * Get Collection
     * 
     * @Route("/api/movies", name="app_api_movies_get_collection", methods={"GET"})
     */
    public function getCollection(MovieRepository $movieRepository): JsonResponse
    {
        // Les données
        // @todo paginer les résultats
        $movies = $movieRepository->findAll();

        return $this->json(
            $movies,
            Response::HTTP_OK,[],[
                'groups' => 'api_movies_get_collection'
            ]
        );
    }

    /**
     * Get Item
     * 
     * @Route("/api/movies/{id}", name="app_api_movies_get_item", methods={"GET"})
     */
    public function getItem(Movie $movie = null): JsonResponse
    {
        // 404 ?
        if (null === $movie) {
            throw $this->createNotFoundException('Film non trouvé');
        }

        return $this->json(
            $movie,
            Response::HTTP_OK,[],[
                'groups' => 'api_movies_get_item'
            ]
        );
    }

    /**
     * Create Item
     *
     * @Route("/api/movies", name="app_api_movies_create_item", methods={"POST"})
     */
    public function createItem(Request $request, SerializerInterface $serializer, EntityManagerInterface $em )
    {
        $getJson = $request->getContent();

        try {
            $movie = $serializer->deserialize($getJson, Movie::class, 'json');

        $movie->setReleaseDate(new \DateTime());

        $em->persist($movie);
        $em->flush();

        return $this->json(
            $movie,
            Response::HTTP_CREATED,[],[
                'groups' => 'api_movies_get_item'
            ]
        );
        } catch (NotEncodableValueException $exeption) {
            return $this->json([
                'status' => 400,
            ])
        }
        

    }

    /**
     * Update Item
     * 
     * @Route("/api/movies/{id}", name="app_api_movies_update_item", methods={"PUT"})
     * 
     */
    public function update (Movie $movie, Request $request) {
        
    }

    /**
     * Delete Item
     *
     * @Route("/api/movies/{id}", name="app_api_movies_delete_item", methods={"DELETE"})
     * 
     */
    public function delete ($id) {

        

    }
}
