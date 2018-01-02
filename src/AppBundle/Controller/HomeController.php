<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{
    /**
     * Matches / exactly
     * @Route("/", name="home_index")
     */
    public function indexAction()
    {
        $latest_movies = $this->getDoctrine()
            ->getRepository(Movie::class)
            ->findLatest();

        return $this->render('home/index.html.twig', [
            'latest_movies' => $latest_movies,
            'popular_movies' => ''
        ]);
    }
}