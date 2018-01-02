<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 19/12/17
 * Time: 21:05
 */

namespace AppBundle\Helpers;


use AppBundle\Entity\Movie;
use AppBundle\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

class MovieHelper
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * MovieHelper constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager) {
        $this->movieRepository = $entityManager->getRepository(Movie::class);
    }

    /**
     * @param string $years in 'yyyy-yyyy...-yyyy' format
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getMoviesByYears(string $years, int $page, int $limit): Paginator {
        return $this->movieRepository->findManyByYears(explode('-', $years), $page, $limit);
    }
}