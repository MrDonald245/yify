<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Quality
 *
 * @ORM\Table(name="qualities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QualityRepository")
 * @Vich\Uploadable()
 */
class Quality
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
     * @var int
     * @ORM\Column(type="integer", unique=true)
     */
    private $format;

    /**
     * @var File
     *
     * @Vich\UploadableField(mapping="quality_image",
     *     fileNameProperty="imageName",
     *     size="imageSize")
     */
    private $image;

    /**
     * @var string
     * @ORM\Column(type="string", name="image_name", unique=true)
     */
    private $imageName;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", name="image_size")
     */
    private $imageSize;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Torrent", mappedBy="quality")
     */
    private $torrents;

    /**
     * Quality constructor.
     */
    public function __construct() {
        $this->torrents = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $format
     * @return Quality
     */
    public function setFormat(int $format): Quality {
        $this->format = $format;
        return $this;
    }

    /**
     * @param string $imageName
     * @return Quality
     */
    public function setImageName(string $imageName): Quality {
        $this->imageName = $imageName;
        return $this;
    }

    /**
     * @param ArrayCollection $torrents
     * @return Quality
     */
    public function setTorrents(ArrayCollection $torrents): Quality {
        $this->torrents = $torrents;
        return $this;
    }

    /**
     * @param File $image
     * @return Quality
     */
    public function setImage(File $image = null): Quality {
        $this->image = $image;
        $this->imageSize = $image->getSize() ?? 0;

        return $this;
    }

    /**
     * @return int
     */
    public function getFormat(): ? int {
        return $this->format;
    }

    /**
     * @return File
     */
    public function getImage(): ? File {
        return $this->image;
    }

    /**
     * @return string
     */
    public function getImageName(): string {
        return $this->imageName;
    }

    /**
     * @return int
     */
    public function getImageSize(): int {
        return $this->imageSize;
    }

    /**
     * @return ArrayCollection
     */
    public function getTorrents(): ArrayCollection {
        return $this->torrents;
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
        $torrent->removeQuality($this);

        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return (string)$this->format;
    }


}

