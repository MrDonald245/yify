<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 06/12/17
 * Time: 20:50
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Quality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class Qualities extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        $q_dir = $this->container->getParameter(
                'kernel.project_dir') . '/web/images/q';

        $image_720 = new File($q_dir . '/720p.png');
        $image_1080 = new File($q_dir . '/1080p.png');

        $quality_720 = new Quality();
        $quality_720->setFormat(720)
            ->setImage($image_720)
            ->setImageName($image_720->getFilename());

        $quality_1080 = new Quality();
        $quality_1080->setFormat(1080)
            ->setImage($image_1080)
            ->setImageName($image_1080->getFilename());

        $manager->persist($quality_720);
        $manager->persist($quality_1080);

        $this->addReference('quality_quality_720', $quality_720);
        $this->addReference('quality_quality_1080', $quality_1080);

        $manager->flush();
    }
}