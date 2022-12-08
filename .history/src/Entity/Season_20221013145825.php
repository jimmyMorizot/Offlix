<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups("api_movies_get_item")
     */
    private $number_episodes;

    /**
     * @ORM\Column(type="integer")
     * @Groups("api_movies_get_item")
     */
    private $number_season;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $releaseDate;

    /**
     * @ORM\ManyToOne(targetEntity=Movie::class, inversedBy="seasons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $movie;

    public function __toString()
    {
        return $this->getNumberEpisodes()." ".$this->getNumberSeason();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberEpisodes(): ?int
    {
        return $this->number_episodes;
    }

    public function setNumberEpisodes(int $number_episodes): self
    {
        $this->number_episodes = $number_episodes;

        return $this;
    }

    public function getNumberSeason(): ?int
    {
        return $this->number_season;
    }

    public function setNumberSeason(int $number_season): self
    {
        $this->number_season = $number_season;

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getMovie(): ?Movie
    {
        return $this->movie;
    }

    public function setMovie(?Movie $movie): self
    {
        $this->movie = $movie;

        return $this;
    }
}