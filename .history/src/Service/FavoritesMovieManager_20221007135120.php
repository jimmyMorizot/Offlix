<?php

namespace App\Service;

use App\Entity\Movie;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Gestion des favoris de l'utilisateur
 */
class FavoritesMovieManager
{
    private $session;

    /**
     * on récupère la session via RequestStack dans le constructeur de notre service
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->session = $requestStack->getSession();
    }

    /**
     * Récupère les favoris
     * 
     * @return Movie[] Liste des films favoris
     */
    public function getFavorites(): array
    {
        // retourne la liste ou un tableau vide
        $favorites = $this->session->get('favorites', []);

        return $favorites;
    }

    /**
     * Ajoute un film aux favoris
     * 
     * @param Movie $movie Le film à ajouter
     */
    public function addToFavorites(Movie $movie)
    {
        // dans session on a plusieurs méthodes disponibles : 
        // - set, pour stocker en session
        // - get, permet de recuper les valeurs d'un index de session
        // - remove, permet de supprimer une session par son index

        // Je récupère la session favorites, si elle n'existe pas un tableau vide par défaut
        $favorites = $this->getFavorites();

        // J'ajoute ce que j'ai a ajouté, j'utilise l'index du film pour éviter les doublons
        $favorites[$movie->getId()] = $movie;

        // et je renvoie le tout dans la session
        $this->session->set('favorites', $favorites);
    }

    /**
     * Supprime un film des favoris
     * 
     * @param Movie $movie Le film à supprimer
     */
    public function removeFromFavorites(Movie $movie)
    {
        // on récupére les favoris
        $favorites = $this->getFavorites();

        // le film à supprimer est-il dans les favoris ?
        if(array_key_exists($movie->getId(), $favorites)){

            // J'unset le film du tableau
            unset($favorites[$movie->getId()]);
            // Je remets le tableau modifié dans la session
            $this->session->set('favorites', $favorites);

            return true;

        }
            return false;
        
    }

    /**
     * Supprimer tous les favoris
     */
    public function removeAllFavorites()
    {
        # code...
    }
}