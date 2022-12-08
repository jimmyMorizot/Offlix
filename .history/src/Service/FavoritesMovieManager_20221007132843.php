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
        // Je récupère la session favorites, si elle n'existe pas un tableau vide par défaut
        $favorites = $session->get('favorites', []);

        // J'ajoute ce que j'ai a ajouté, j'utilise l'index du film pour éviter les doublons
        $favorites[$id] = $movie;

        // et je renvoi le tout
        $session->set('favorites',$favorites);
    }

    /**
     * Supprime un film des favoris
     * 
     * @param Movie $movie Le film à supprimer
     */
    public function removeFromFavorites(Movie $movie)
    {
        # code...
    }

    /**
     * Supprimer tous les favoris
     */
    public function removeAllFavorites()
    {
        # code...
    }
}