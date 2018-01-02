<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Torrent
 *
 * @ORM\Table(name="torrents")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TorrentRepository")
 * @Vich\Uploadable()
 */
class Torrent
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
     * @var File
     *
     * @Vich\UploadableField(mapping="torrent_file",
     *     fileNameProperty="fileName",
     *     size="fileSize")
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(type="string", name="file_name", unique=true)
     */
    private $fileName;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="file_size")
     */
    private $fileSize;

    /**
     * @var string
     *
     * @ORM\Column(type="text", name="magnet_link")
     */
    private $magnetLink;

    /**
     * @var Movie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie", inversedBy="torrents")
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    private $movie;

    /**
     * @var Quality
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Quality", inversedBy="torrents")
     * @ORM\JoinColumn(name="quality_id", referencedColumnName="id")
     */
    private $quality;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return File
     */
    public function getFile(): File {
        return $this->file;
    }

    /**
     * @return string
     */
    public function getFileName(): string {
        return $this->fileName;
    }

    /**
     * @return int
     */
    public function getFileSize(): int {
        return $this->fileSize;
    }

    /**
     * @return string
     */
    public function getMagnetLink(): string {
        return $this->magnetLink;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie {
        return $this->movie;
    }

    /**
     * @return Quality
     */
    public function getQuality(): Quality {
        return $this->quality;
    }

    /**
     * @param File $file
     * @return Torrent
     */
    public function setFile(File $file = null): Torrent {
        $this->file = $file;
        $this->fileSize = $file->getSize() ?? 0;

        return $this;
    }

    /**
     * @param string $fileName
     * @return Torrent
     */
    public function setFileName(string $fileName): Torrent {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @param string $magnetLink
     * @return Torrent
     */
    public function setMagnetLink(string $magnetLink): Torrent {
        $this->magnetLink = $magnetLink;

        return $this;
    }

    /**
     * @param Movie $movie
     * @return Torrent
     */
    public function setMovie(Movie $movie): Torrent {
        $this->movie = $movie;

        return $this;
    }

    /**
     * @param Quality $quality
     * @return Torrent
     */
    public function setQuality(Quality $quality): Torrent {
        $this->quality = $quality;

        return $this;
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function removeMovie(Movie $movie): bool {
        if ($this->movie->getId() !== $movie->getId()) {
            return false;
        }

        $this->movie = null;
        return true;
    }

    /**
     * @param Quality $quality
     * @return bool
     */
    public function removeQuality(Quality $quality): bool {
        if ($this->quality->getId() !== $quality->getId()) {
            return false;
        }

        $this->quality = null;
        return true;
    }
}