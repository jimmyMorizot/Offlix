<?php

namespace App\Controller\Api;

use Serializable;
use App\Entity\Movie;
use App\Repository\MovieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * Create Movie
     * 
     * @Route("/api/movies", name="app_api_movies_post_item", methods={"POST"})
     */
    public function postItem(Request $request, SerializerInterface $serializer, ManagerRegistry $doctrine, ValidatorInterface $validator)
    {
        // @see https://symfony.com/doc/5.4/components/serializer.html

        // on récupère le contenu JSON
        $jsonContent = $request->getContent();

        // on le "désérialise" grâce au Serializer
        $movie = $serializer->deserialize($jsonContent, Movie::class, 'json');
        //dd($movie);

        // validation de l'entité
        // @see https://symfony.com/doc/5.4/validation.html#using-the-validator-service
        $errors = $validator->validate($movie);

        // y'a-t-il des erreurs ?
        if (count($errors) > 0) {
            
            // #####################
            // avec Twig (possible mais nécessiterait traitement en amont)
            // @see https://symfony.com/doc/5.4/validation.html#using-the-validator-service
            // #####################
            //dd($errors);

            /* return $this->render('api/movie/errors.json.twig', [
                'errors' => $errors,
            ], new JsonResponse(null, Response::HTTP_UNPROCESSABLE_ENTITY)); */

            // #####################
            // en pur code
            // #####################

            // tableau d'erreurs "propre"
            $errorsClean = [];

            /** @var ConstraintViolation $error L'erreur */
            foreach($errors as $error) {
                // on pousse l'erreur à la clé qui correspond à la propriété en erreur
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json([
                'errors' => $errorsClean
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // on persist et flush l'entité
        $manager = $doctrine->getManager();
        $manager->persist($movie);
        $manager->flush();
        // OU faire $movieRepository->add($movie);

        // status 201 (HTTP_CREATED) + header Location: endpoint de la ressource
        // bonus réponse : on renvoie aussi la donnée crée (pas demandée par REST)
        return $this->json(
            $movie,
            Response::HTTP_CREATED,
            ['Location' => $this->generateUrl('app_api_movies_get_item', [
                    'id' => $movie->getId()
                ])
            ],
            ['groups' => 'api_movies_get_item']
        );
    }

    /**
     * Update Item
     * 
     * @Route("/api/movies/{id}", name="app_api_movies_update_item", methods={"PATCH"})
     * 
     */
    public function updateItem (Request $request, SerializerInterface $serializer,ManagerRegistry $doctrine, ValidatorInterface $validator) {
        
        // on récupère le contenu JSON
        $jsonContent = $request->getContent();

        // on le "désérialise" grâce au Serializer
        $serializer->deserialize($jsonContent, Movie::class, 'xml', [AbstractNormalizer::OBJECT_TO_POPULATE => $movie]);
        //dd($movie);

        // validation de l'entité
        $errors = $validator->validate($movie);

        // y'a-t-il des erreurs ?
        if (count($errors) > 0) {

            // tableau d'erreurs "propre"
            $errorsClean = [];

            /** @var ConstraintViolation $error L'erreur */
            foreach($errors as $error) {
                // on pousse l'erreur à la clé qui correspond à la propriété en erreur
                $errorsClean[$error->getPropertyPath()][] = $error->getMessage();
            }

            return $this->json([
                'errors' => $errorsClean
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // on persist et flush l'entité
        $manager = $doctrine->getManager();
        $manager->persist($movie);
        $manager->flush();
        
        return $this->json(
            $movie,
            Response::HTTP_CREATED,
            ['Location' => $this->generateUrl('app_api_movies_get_item', [
                    'id' => $movie->getId()
                ])
            ],
            ['groups' => 'api_movies_get_item']
        );
    }

    /**
     * Delete Item
     *
     * @Route("/api/movies/{id}", name="app_api_movies_delete_item", methods={"DELETE"})
     * 
     */
    public function deleteItem ($id) {

        

    }
}
