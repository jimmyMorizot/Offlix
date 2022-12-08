<?php

namespace App\Controller\Front;

use App\Entity\Movie;
use App\Service\FavoritesMovieManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FavoriteController extends AbstractController
{
    /**
     * display the movies in favorites by the user
     * 
     * @Route("/favorite", name="favorite_list", methods={"GET"})
     */
    public function list(FavoritesMovieManager $favoritesMovieManager): Response
    {
        $favorites = $favoritesMovieManager->getFavorites();

        return $this->render('front/favorite/list.html.twig', [
            'favorites' => $favorites,
        ]);
    }

    /**
     * add a favorite to my list of favorites in session
     * 
     * @Route("/favorite/add/{id}", name="favorite_add" , requirements={"id"="\d+"}, methods={"GET"})
     */
    public function add(int $id, FavoritesMovieManager $favoritesMovieManager, Movie $movie = null): Response
    {

        // Plus utile, avec le param converter une 404 sera levé si le film n'existe pas
        if($movie === null) {

            $this->addFlash(
                'danger',
                'Film inexistant !'
            );

            return $this->redirectToRoute('favorite_list');
        }



        // On indique à l'utilisateur que tout c'est bien passé
        $this->addFlash(
            'success',
            $movie->getTitle(). ' ajouté au favoris'
        );


        return $this->redirectToRoute('favorite_list');
    }

       /**
     * remove a movie from from session favorite
     * 
     * @Route("/favorite/remove/{id}", name="favorite_remove", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function remove(RequestStack $requestStack, int $id): Response
    {
        $session = $requestStack->getSession();

        $favorites = $session->get('favorites');


        if(array_key_exists($id, $favorites)){
            // J'unset le film du tableau
            unset($favorites[$id]);
            $this->addFlash(
                'warning',
                'Le film a bien été supprimé de votre liste .'
            );
            // Je remets le tableau modifié dans la session
            $session->set('favorites', $favorites);
        }else{
            $this->addFlash(
                'danger',
                'Le film n\'existe pas !'
            );
        }

        return $this->redirectToRoute('favorite_list');
    }

       /**
     * remove all movies from session favorites
     * 
     * @Route("/favorite/empty", name="favorite_empty", methods={"GET"})
     */
    public function empty(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();

        // Suppresion de toute les entrées favorites dans la session
        $session->remove('favorites');
        $this->addFlash(
            'Warning',
            'Votre liste de favoris est maintenant vide'
        );


        return $this->redirectToRoute('favorite_list');
    }
}
