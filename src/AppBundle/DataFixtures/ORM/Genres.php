<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 20/11/17
 * Time: 17:14
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Genre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class Genres extends Fixture
{
    private $genreNames = [
        'Action',  'Adventure', 'Animation',    'Biography',
        'Comedy',  'Crime',     'Documentary',  'Drama',
        'Family',  'Fantasy',   'History',      'Horror',
        'Musical', 'Mystery',   'Romance',      'Sci-Fi',
        'Sport',   'Thriller',  'War',          'Western'
    ];

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        for ($i = 0; $i < sizeof($this->genreNames); ++$i) {
            $genre = new Genre();
            $genre->setName($this->genreNames[$i]);
            $manager->persist($genre);
            $g_num = $i + 1;
            $this->addReference('genre' . $g_num, $genre);
        }

        $manager->flush();
    }
}