<?php
/**
 * Created by PhpStorm.
 * User: eugene
 * Date: 07/11/17
 * Time: 15:51
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Role;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Users extends Fixture
{
    /**
     * @return array of dependencies
     */
    public function getDependencies() {
        return [Roles::class];
    }


    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $encoder = $this->container->get('security.password_encoder');

        $user_admin = new User();
        $user_admin->setUsername('admin')
            ->setEmail('ebocharnikov96@gmail.com')
            ->setPassword($encoder->encodePassword($user_admin, 'admin'))
            ->addRole($this->getReference('role-role-admin'));

        $manager->persist($user_admin);
        $manager->flush();
    }
}