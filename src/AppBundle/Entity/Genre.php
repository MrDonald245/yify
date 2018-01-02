<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genres")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenreRepository")
 */
class Genre
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65, unique=true)
     */
    private $name = "";

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Movie", mappedBy="genres")
     */
    private $movies;

    /**
     * Genre constructor.
     */
    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getMovies(): ArrayCollection
    {
        return $this->movies;
    }

    /**
     * @param string $name
     * @return Genre
     */
    public function setName(string $name): Genre
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param ArrayCollection $movies
     * @return Genre
     */
    public function setMovies(ArrayCollection $movies): Genre
    {
        $this->movies = $movies;
        return $this;
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function addMovie(Movie $movie): bool
    {
        if ($this->movies->contains($movie)) {
            return false;
        }

        $this->movies->add($movie);
        $movie->addGenre($this);

        return true;
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function removeMovie(Movie $movie): bool
    {
        if (!$this->movies->contains($movie)){
            return false;
        }

        $this->movies->removeElement($movie);
        $movie->removeGenre($this);

        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->getName();
    }
}

