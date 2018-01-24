<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 19/12/17
 * Time: 21:05
 */

namespace AppBundle\Helpers;


use AppBundle\Entity\Movie;
use AppBundle\Entity\Quality;
use AppBundle\Entity\Torrent;
use AppBundle\Repository\MovieRepository;
use AppBundle\Repository\QualityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MovieHelper
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;
    /**
     * @var QualityRepository
     */
    private $qualityRepository;
    /**
     * @var ContainerInterface
     */
    private $container;


    /**
     * MovieHelper constructor.
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManagerInterface $entityManager, ContainerInterface $container) {
        $this->movieRepository = $entityManager->getRepository(Movie::class);
        $this->qualityRepository = $entityManager->getRepository(Quality::class);
        $this->container = $container;
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
     * @return PaginationInterface
     */
    public function getByYears(string $years, int $page, int $limit): PaginationInterface {
        return $this->getPaginator()->paginate(
            $this->movieRepository->getManyByYearsQuery(
                explode('-', $years)), $page, $limit);
    }

    /**
     * @param string $genres
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function getByGenres(string $genres, int $page, int $limit) {
        return $this->getPaginator()->paginate(
            $this->movieRepository->getManyByGenresQuery(
                explode('-', $genres)), $page, $limit, ['wrap-queries' => true]);
    }

    /**
     * @param int $page
     * @param int $limit
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     */
    public function getRecent(int $page, int $limit): PaginationInterface {
        return $this->getPaginator()->paginate(
            $this->movieRepository->getRecentQuery(), $page, $limit);
    }

    /**
     * @param int $movieId
     * @return mixed
     */
    public function getQualities(int $movieId) {
        return $this->qualityRepository->findManyByMovieId($movieId);
    }

    /**
     * @param int $page
     * @param array $filters
     * @return PaginationInterface
     */
    public function browse(int $page, array $filters): PaginationInterface {
        $keyword = isset($filters['keyword']) ? $filters['keyword'] : null;
        $quality = isset($filters['quality']) ? $filters['quality'] : null;
        $genres = isset($filters['genres']) ? $filters['genres'] : null;
        $rating = isset($filters['rating']) ? (int)$filters['rating'] : null;
        $orderBy = isset($filters['orderby']) ? $filters['orderby'] : null;
        $limit = isset($filters['limit']) ? $filters['limit'] : 20;

        return $this->getPaginator()->paginate(
            $this->movieRepository->getByFiltersQuery(
                $keyword, $quality, $genres, $rating, $orderBy),
            $page,
            $limit
        );
    }

    /**
     * @param Torrent $torrent
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function download(Torrent $torrent): void {
        $movie = $this->movieRepository->findByTorrent($torrent);
        $this->movieRepository->downloadCountIterate($movie);
    }

    /**
     * @return \Knp\Component\Pager\Paginator|object
     */
    private function getPaginator(): Paginator {
        return $this->container->get('knp_paginator');
    }
}