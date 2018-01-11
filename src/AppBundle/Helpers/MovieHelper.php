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
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MovieHelper
{
    /**
     * @var MovieRepository
     */
    private $movieRepository;
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
                explode('-', $genres)), $page, $limit, ['wrap-queries'=>true]);
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