<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Movie
 *
 * @ORM\Table(name="movies")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MovieRepository")
 * @Vich\Uploadable()
 * @ORM\HasLifecycleCallbacks
 */
class Movie
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
     * @ORM\Column(type="string", length=65)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     */
    private $size;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=65)
     */
    private $runtime;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45)
     */
    private $language;
    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", name="release_date")
     */
    private $releaseDate;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $directors;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $writers;
    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $cast;
    /**
     * @var string
     *
     * @ORM\Column(type="text", name="description" )
     */
    private $description;
    /**
     * @var float
     *
     * @ORM\Column(type="float", name="imdb_rating")
     */
    private $imdbRating;
    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Genre",
     *     inversedBy="movies")
     * @ORM\JoinTable(
     *     joinColumns={
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     *     },
     *     inverseJoinColumns={
     * @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     *     }
     * )
     */
    private $genres;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Screenshot", mappedBy="movie", cascade={"persist"})
     */
    private $screenshots;
    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Torrent", mappedBy="movie")
     */
    private $torrents;
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="youtube_link")
     */
    private $youtubeLink;
    /**
     * @var string
     *
     * @ORM\Column(type="string", name="imdb_link", nullable=true)
     */
    private $imdbLink;
    /**
     * @var File
     *
     * @Vich\UploadableField(
     *     mapping="movie_poster", fileNameProperty="posterName",
     *     size="posterSize")
     */
    private $posterImage;
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="poster_name")
     */
    private $posterName;
    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="poster_size")
     */
    private $posterSize;
    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", name="created_at")
     */
    private $createdAt;
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $downloaded;

    /**
     * Movie constructor.
     */

    public function __construct() {
        $this->downloaded = 0;
        $this->releaseDate = new DateTime();
        $this->genres = new ArrayCollection();
        $this->screenshots = new ArrayCollection();
        $this->torrents = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ? string {
        return $this->name;
    }


    /**
     * @return string
     */
    public function getSize(): ? string {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getRuntime(): ? string {
        return $this->runtime;
    }

    /**
     * @return string
     */
    public function getLanguage(): ? string {
        return $this->language;
    }

    /**
     * @return DateTime
     */
    public function getReleaseDate(): ? DateTime {
        return $this->releaseDate;
    }

    /**
     * @param string $template
     * @return string
     */
    public function getReleaseDateStr(string $template = 'j F Y'): string {
        return $this->getReleaseDate()->format($template);
    }

    /**
     * @return float
     */
    public function getImdbRating(): ? float {
        return $this->imdbRating;
    }

    /**
     * @return string
     */
    public function getDirectors(): ? string {
        return $this->directors;
    }

    /**
     * @return string
     */
    public function getWriters(): ? string {
        return $this->writers;
    }

    /**
     * @return string
     */
    public function getCast(): ? string {
        return $this->cast;
    }

    /**
     * @return string
     */
    public function getDescription(): ? string {
        return $this->description;
    }

    /**
     * @return Collection
     */
    public function getGenres(): Collection {
        return $this->genres;
    }

    /**
     * @return Collection
     */
    public function getScreenshots(): Collection {
        return $this->screenshots;
    }

    /**
     * @return string
     */
    public function getYoutubeLink(): ? string {
        return $this->youtubeLink;
    }

    /**
     * @return string
     */
    public function getImdbLink(): ? string {
        return $this->imdbLink;
    }

    /**
     * @return DateTime
     */
    public function getUpdatedAt(): ? DateTime {
        return $this->updatedAt;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): ? DateTime {
        return $this->createdAt;
    }


    /**
     * @return File
     */
    public function getPosterImage() {
        return $this->posterImage;
    }

    /**
     * @return string
     */
    public function getPosterName(): ? string {
        return $this->posterName;
    }

    /**
     * @return int
     */
    public function getPosterSize(): ? int {
        return $this->posterSize;
    }

    /**
     * @return ArrayCollection
     */
    public function getTorrents(): Collection {
        return $this->torrents;
    }


    /**
     * @return int
     */
    public function getDownloaded(): int {
        return $this->downloaded;
    }

    /**
     * @param string $name
     * @return Movie
     */
    public function setName(string $name): Movie {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $size
     * @return Movie
     */
    public function setSize(string $size): Movie {
        $this->size = $size;
        return $this;
    }

    /**
     * @param string $runtime
     * @return Movie
     */
    public function setRuntime(string $runtime): Movie {
        $this->runtime = $runtime;
        return $this;
    }

    /**
     * @param string $language
     * @return Movie
     */
    public function setLanguage(string $language): Movie {
        $this->language = $language;
        return $this;
    }

    /**
     * @param DateTime $releaseDate
     * @return Movie
     */
    public function setReleaseDate(DateTime $releaseDate): Movie {
        $this->releaseDate = $releaseDate;
        return $this;
    }

    /**
     * @param float $imdbRating
     * @return Movie
     */
    public function setImdbRating(float $imdbRating): Movie {
        $this->imdbRating = $imdbRating;
        return $this;
    }

    /**
     * @param string $directors
     * @return Movie
     */
    public function setDirectors(string $directors): Movie {
        $this->directors = $directors;
        return $this;
    }

    /**
     * @param int $posterSize
     */
    public function setPosterSize(? int $posterSize) {
        $this->posterSize = $posterSize;
    }

    /**
     * @param string $writers
     * @return Movie
     */
    public function setWriters(string $writers): Movie {
        $this->writers = $writers;
        return $this;
    }

    /**
     * @param string $cast
     * @return Movie
     */
    public function setCast(string $cast): Movie {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @param string $description
     * @return Movie
     */
    public function setDescription(string $description): Movie {
        $this->description = $description;
        return $this;
    }

    /**
     * @param ArrayCollection $genres
     * @return Movie
     */
    public function setGenres(ArrayCollection $genres): Movie {
        $this->genres = $genres;
        return $this;
    }


    /**
     * @param string $youtubeLink
     * @return Movie
     */
    public function setYoutubeLink(string $youtubeLink): Movie {
        $this->youtubeLink = $youtubeLink;
        return $this;
    }

    /**
     * @param string $imdbLink
     * @return Movie
     */
    public function setImdbLink(string $imdbLink): Movie {
        $this->imdbLink = $imdbLink;
        return $this;
    }

    /**
     * @param DateTime $updatedAt
     * @return Movie
     */
    public function setUpdatedAt(DateTime $updatedAt): Movie {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @param File $posterImage
     * @return Movie
     */
    public function setPosterImage(File $posterImage = null): Movie {
        $this->posterImage = $posterImage;

        if ($posterImage) {
            $this->posterSize = $posterImage->getSize();
            $this->posterName = $posterImage->getFilename();
        } else {
            $this->posterSize = 0;
        }

        return $this;
    }

    /**
     * @param string $posterName
     * @return Movie
     */
    public function setPosterName(? string $posterName = null): Movie {
        $this->posterName = $posterName;
        return $this;
    }

    /**
     * @param ArrayCollection $screenshots
     * @return Movie
     */
    public function setScreenshots(ArrayCollection $screenshots): Movie {
        $this->screenshots = $screenshots;
        return $this;
    }

    /**
     * @param ArrayCollection $torrents
     * @return Movie
     */
    public function setTorrents(ArrayCollection $torrents): Movie {
        $this->torrents = $torrents;
        return $this;
    }

    /**
     * @param int $downloaded
     * @return Movie
     */
    public function setDownloaded(int $downloaded): Movie {
        $this->downloaded = $downloaded;
        return $this;
    }

    /**
     * @param Genre $genre
     * @return bool
     */
    public function addGenre(Genre $genre): bool {
        if ($this->genres->contains($genre)) {
            return false;
        }

        $this->genres->add($genre);
        $genre->addMovie($this);

        return true;
    }

    /**
     * @param Genre $genre
     * @return bool
     */
    public function removeGenre(Genre $genre): bool {
        if (!$this->genres->contains($genre)) {
            return false;
        }

        $this->genres->removeElement($genre);
        $genre->removeMovie($this);

        return true;
    }

    /**
     * @param Screenshot $screenshot
     * @return bool
     */
    public function addScreenshot(Screenshot $screenshot): bool {
        if ($this->screenshots->contains($screenshot)) {
            return false;
        }

        $this->screenshots->add($screenshot);
        $screenshot->setMovie($this);

        return true;
    }

    /**
     * @param Screenshot $screenshot
     * @return bool
     */
    public function removeScreenshot(Screenshot $screenshot): bool {
        if (!$this->screenshots->contains($screenshot)) {
            return false;
        }

        $this->screenshots->removeElement($screenshot);
        $screenshot->removeMovie($this);

        return true;
    }

    /**
     * @param Torrent $torrent
     * @return bool
     */
    public function addTorrent(Torrent $torrent): bool {
        if ($this->torrents->contains($torrent)) {
            return false;
        }

        $this->torrents->add($torrent);
        $torrent->setMovie($this);

        return true;
    }

    /**
     * @param Torrent $torrent
     * @return bool
     */
    public function removeTorrent(Torrent $torrent): bool {
        if (!$this->torrents->contains($torrent)) {
            return false;
        }

        $this->torrents->removeElement($torrent);
        $torrent->removeMovie($this);

        return true;
    }

    /**
     * Checks whether a movie has both genres and torrents.
     *
     * @return bool
     */
    public function isReadyToBeShown(): bool {
        return !$this->genres->isEmpty()
            && !$this->torrents->isEmpty();
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps(): void {
        $this->updatedAt = new DateTime('now');

        if ($this->createdAt == null) {
            $this->createdAt = new DateTime('now');
        }
    }
}