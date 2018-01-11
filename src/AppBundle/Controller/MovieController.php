<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use AppBundle\Entity\Torrent;
use AppBundle\Helpers\MovieHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MovieController extends Controller
{
    /**
     * @var MovieHelper
     */
    private $movieHelper;
    private $limit;

    public function __construct(MovieHelper $movieHelper, ContainerInterface $container) {
        $this->movieHelper = $movieHelper;
        $this->limit = $container->getParameter('paginator_limit');
    }

    /**
     * @Route("/movie/{movie}/quality/{quality}", name="movie_show")
     * @param Movie $movie
     * @param int $quality
     * @return Response
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function showMovieAction(Movie $movie, int $quality): Response {
        $torrent = $this->getDoctrine()->getRepository(Torrent::class)
            ->findOneByMovieIdAndFormat($movie->getId(), $quality);

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
            'torrent' => $torrent,
        ]);
    }

    /**
     * @Route("/years/{years}/{page}", name="movie_years",
     *     requirements={"years"="([0-9]{4}-?)+", "page"="\d+"})
     *
     * @param int $page
     * @param string $years
     * @return Response
     */
    public function filterByYearsAction(int $page = 1, string $years = null): Response {
        $movies = null;

        if (isset($years)) {
            $movies = $this->movieHelper->getByYears($years, $page, $this->limit);
        }

        return $this->render('movie/years.html.twig', [
            'uri' => $years,
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/genres/{genres}/{page}", name="movie_genres",
     *     requirements={"genres"="(\w+-?)+", "page"="\d+"})
     *
     * @param int $page
     * @param string|null $genres
     * @return Response
     */
    public function filterByGenresAction(int $page = 1, string $genres = null): Response {
        $movies = null;

        if (isset($genres)) {
            $movies = $this->movieHelper->getByGenres($genres, $page, $this->limit);
        }

        return $this->render('movie/genres.html.twig', [
            'uri' => $genres,
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/recent/{page}", name="movie_recent",
     *     requirements={"page"="\d+"})
     *
     * @param int $page
     * @return Response
     */
    public function showRecentAction(int $page = 1): Response {
        $movies = $this->movieHelper->getRecent($page, $this->limit);

        return $this->render('movie/recent.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/download/{torrent}/{magnet}", name="movie_download",
     *     requirements={"magnet"="magnet"})
     *
     * @param Torrent $torrent
     * @param string|null $magnet
     * @return Response
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function download(Torrent $torrent, string $magnet = null): Response {
        $this->movieHelper->download($torrent);

        $isMagnet = $magnet == 'magnet';
        $helper = $this->container->get('vich_uploader.templating.helper.uploader_helper');

        $url = $isMagnet
            ? $torrent->getMagnetLink()
            : $helper->asset($torrent, 'file');

        return $this->redirect($url);
    }
}