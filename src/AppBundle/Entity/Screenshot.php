<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Screenshot
 *
 * @ORM\Table(name="screenshots")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ScreenshotRepository")
 * @Vich\Uploadable()
 */
class Screenshot
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
     * @Vich\UploadableField(mapping="movie_screenshot",
     *     fileNameProperty="imageName",
     *     size="image_size")
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, name="image_name")
     */
    private $imageName;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="image_size")
     */
    private $imageSize;

    /**
     * @var Movie
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movie", inversedBy="screenshots", cascade={"persist"})
     * @ORM\JoinColumn(name="movie_id", referencedColumnName="id")
     */
    private $movie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", name="updated_at")
     */
    private $updatedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return Movie
     */
    public function getMovie(): Movie {
        return $this->movie;
    }

    /**
     * @param Movie $movie
     * @return Screenshot
     */
    public function setMovie(Movie $movie): Screenshot {
        $this->movie = $movie;
        return $this;
    }

    /**
     * @param Movie $movie
     * @return bool
     */
    public function removeMovie(Movie $movie): bool {
        if ($movie->getId() !== $this->getId()) {
            return false;
        }

        $this->movie = null;
        return true;
    }

    /**
     * @return File
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getImageName(): ? string {
        return $this->imageName;
    }

    /**
     * @return int
     */
    public function getImageSize(): int {
        return $this->imageSize;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }


    /**
     * @param File $image
     * @return Screenshot
     */
    public function setImage(File $image = null): Screenshot {
        $this->image = $image;

        if ($image) {
            if ($this->imageSize != $image->getSize()) {
                $this->updatedAt = new \DateTime();
            }
            $this->imageSize = $image->getSize();
            $this->imageName = $image->getFilename();
        } else {
            $this->imageSize = 0;
        }

        return $this;
    }

    /**
     * @param string $imageName
     * @return Screenshot
     */
    public function setImageName(string $imageName = null): Screenshot {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @param int $imageSize
     * @return Screenshot
     */
    public function setImageSize(int $imageSize = null): Screenshot {
        $this->imageSize = $imageSize;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->imageName ?? 'Screenshot';
    }
}