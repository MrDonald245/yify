<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 20/11/17
 * Time: 18:46
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Roles extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load(ObjectManager $manager) {
        $role_admin = new Role();
        $role_admin->setName('ROLE_ADMIN');

        $manager->persist($role_admin);

        $this->addReference('role-role-admin', $role_admin);

        $manager->flush();
    }
}