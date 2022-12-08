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
        # code...
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