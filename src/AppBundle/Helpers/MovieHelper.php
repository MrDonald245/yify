<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 19/12/17
 * Time: 21:05
 */

namespace AppBundle\Helpers;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Torrent;
use AppBundle\Repository\MovieRepository;
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
     * @return array
     */
    public function getLatest(): array {
        return $this->movieRepository->findLatest();
    }

    /**
     * @return array
     */
    public function getPopular(): array {
        return $this->movieRepository->findPopular();
    }

    /**
     * @param string $years in 'yyyy-yyyy...-yyyy' format
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getByYears(string $years, int $page, int $limit): Paginator {
        return $this->movieRepository->findManyByYears(explode('-', $years), $page, $limit);
    }

    /**
     * @param string $years
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getByGenres(string $years, int $page, int $limit): Paginator {
        return $this->movieRepository->findManyByGenres(explode('-', $years), $page, $limit);
    }

    /**
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getRecent(int $page, int $limit):Paginator {
        return $this->movieRepository->findRecent($page, $limit);
    }

    /**
     * @param Torrent $torrent
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function download(Torrent $torrent): void {
        $movie = $this->movieRepository->findByTorrent($torrent);
        $this->movieRepository->downloadCountIterate($movie);
    }
}