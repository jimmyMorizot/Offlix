<?php

namespace App\Service;

use App\Entity\Movie;
use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{

    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function slugMovieTitle(Movie $movie, SluggerInterface $slugger)
    {
        $movie->setSlug(strtolower($this->slugger->slug($movie->getTitle())));
    }

}