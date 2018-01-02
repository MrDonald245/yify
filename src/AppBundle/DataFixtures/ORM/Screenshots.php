<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 20/11/17
 * Time: 18:25
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Screenshot;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;

class Screenshots extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        $s_dir = $this->container->getParameter(
                'kernel.project_dir') . '/web/images/screenshots';

        for ($i = 1; $i <= 10; ++$i) {
            for ($j = 1; $j <= 3; ++$j) {
                $file = new File("$s_dir/screenshot$i-$j.jpg");
                $screenshot = new Screenshot();
                $screenshot->setImage($file)
                    ->setImageName($file->getFilename());
                $manager->persist($screenshot);
                $this->addReference("screenshot$i-$j", $screenshot);
            }
        }

        $manager->flush();
    }
}