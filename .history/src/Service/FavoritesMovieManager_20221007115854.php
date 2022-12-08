<?php

namespace App\Service;

use App\Entity\Movie;

/**
 * Gestion des favoris de l'utilisateur
 */
class FavoritesMovieManager
{
    /**
     * Récupère les favoris
     * 
     * @return Movie[] Liste des favoris
     */
    public function getFavorites()
    {
        # code...
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
     * Supprime un film aux favoris
     * 
     * @param Movie $movie Le film à supprimer
     */
    public function removeToFavorites(Movie $movie)
    {
        # code...
    }

    /**
     * Supprimer tous favoris
     * 
     */
    public function removeAllFavorites(Movie $movie)
    {
        # code...
    }
}