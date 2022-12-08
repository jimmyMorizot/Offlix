<?php

namespace App\Service;

use App\Entity\Movie;
use Symfony\Component\String\Slugger\SluggerInterface;

class MySlugger
{

    /** @var SluggerInterface $slugger le service Slugger */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function slugify(string $string, Movie $movie)
    {
        return $this->slugger->slug($string);
    }

}