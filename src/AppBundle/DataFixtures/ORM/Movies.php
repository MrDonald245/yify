<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 09/11/17
 * Time: 20:39
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Movie;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class Movies extends Fixture
{
    /**
     * @var String[]['name', 'realiseDate]
     */
    private $movieData;

    /**
     * Movies constructor.
     */
    public function __construct() {
        $this->movieData = [
            ['name' => 'Revolt', 'releaseDate' => '1 July 2017'],
            ['name' => 'Goon: Last of the Enforcers', 'releaseDate' => '1 July 2016'],
            ['name' => 'A Ghost Story', 'releaseDate' => '1 July 2015'],
            ['name' => 'The Bad Batch', 'releaseDate' => '1 July 2014'],
            ['name' => 'Certain Women', 'releaseDate' => '1 July 2013'],
            ['name' => 'Despicable Me 3', 'releaseDate' => '1 July 2012'],
            ['name' => '47 Meters Down', 'releaseDate' => '1 July 2011'],
            ['name' => 'Transformers: The Last Knight', 'releaseDate' => '1 July 2010'],
            ['name' => 'Pirates of the Caribbean: Dead Men Tell No Tales', 'releaseDate' => '1 July 2009'],
            ['name' => 'The Big Sick', 'releaseDate' => '1 July 2008']
        ];
    }

    /**
     * @return array of dependencies
     */
    public function getDependencies() {
        return [
            Genres::class,
            Screenshots::class,
            Qualities::class,
            Torrents::class,
        ];
    }

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $p_dir = $this->container->getParameter(
                'kernel.project_dir') . '/web/images/posters';

        for ($i = 0; $i < 10; ++$i) {
            $movie_number = $i + 1;
            $poster = new File($p_dir . "/$movie_number.jpg");

            $movie = new Movie();
            $movie->setName($this->movieData[$i]['name'])
                ->setCast('Lee Pace, Bérénice Marlohe, Kenneth Fok, 
                         Tom Fairfoot, Alan Santini, Noko \'Flow\' Mabitsela, 
                         Edwin Jay, Ingmar Büchner, Barileng Malebye, Carl Roddam')
                ->setDirectors('Joe Miale')
                ->setImdbRating(rand(50, 100) / 10)
                ->setLanguage('English')
                ->setDescription('The story of humankind\'s last stand against a 
                                    cataclysmic alien invasion. Set in the war-ravaged 
                                    African countryside, a U.S. 
                                    soldier and a French foreign aid worker team up to survive 
                                    the alien onslaught. 
                                    Their bond will be tested as they search for refuge 
                                    across a crumbling world.')
                ->setRuntime('87 minutes / 01 h 27 m')
                ->setReleaseDate(new DateTime($this->movieData[$i]['releaseDate']))
                ->setSize('744.53 MB')
                ->setWriters('Rowan Athale, Joe Miale')
                ->setImdbLink('#')
                ->setYoutubeLink('#')
                ->setPosterImage($poster)
                ->setPosterName($poster->getFilename())
                ->setDownloaded(rand(0, 100));

            $g_max_count = rand(3, 6);
            for ($g_count = 0; $g_count < $g_max_count; ++$g_count) {
                $movie->addGenre($this->getReference('genre' . rand(1, 20)));
            }

            $movie->addScreenshot($this->getReference("screenshot$movie_number-1"));
            $movie->addScreenshot($this->getReference("screenshot$movie_number-2"));
            $movie->addScreenshot($this->getReference("screenshot$movie_number-3"));

            $movie->addTorrent($this->getReference("torrent$movie_number-720p"));
            $movie->addTorrent($this->getReference("torrent$movie_number-1080p"));

            $manager->persist($movie);
        }

        $manager->flush();
    }
}