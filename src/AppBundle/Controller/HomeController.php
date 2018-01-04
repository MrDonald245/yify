<?php

namespace AppBundle\Controller;

use AppBundle\Helpers\MovieHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class HomeController extends Controller
{
    /**
     * @var MovieHelper
     */
    private $movieHelper;

    /**
     * HomeController constructor.
     *
     * @param MovieHelper $movieHelper
     */
    public function __construct(MovieHelper $movieHelper) {
        $this->movieHelper = $movieHelper;
    }

    /**
     * Matches / exactly
     * @Route("/", name="home_index")
     */
    public function indexAction() {
        return $this->render('home/index.html.twig', [
            'latest_movies' => $this->movieHelper->getLatest(),
            'popular_movies' => $this->movieHelper->getPopular()
        ]);
    }
}