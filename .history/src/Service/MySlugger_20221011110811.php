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

    /** @var $toLower La chaine doit-elle passer en minuscule ? */
    private $toLower;

    public function __construct(SluggerInterface $slugger, bool $toLower)
    {
        $this->slugger = $slugger;
        $this->toLower = $toLower;
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
        if ($this->toLower) {
            return $slug = $this->slugger->slug($string)->lower();
        }
            
        return $slug = $this->slugger->slug($string)->lower();
    }
}