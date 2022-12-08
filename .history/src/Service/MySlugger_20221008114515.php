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

}