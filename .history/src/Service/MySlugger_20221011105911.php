<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;

/**
 * Slugifie une chaine
 */
class MySlugger
{
    /** @var SluggerInterface $slugger Le service Slugger */
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    /**
     * Slugifie une chaine
     * 
     * @param string $string chaine à transformer
     * 
     * @return string La chaine transformée
     */
    public function slugify(string $string): string
    {
        return $this->slugger->slug($string)->lower();
    }
}