<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Role
 *
 * @ORM\Table(name="roles")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RoleRepository")
 */
class Role extends \Symfony\Component\Security\Core\Role\Role
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=45, unique=true)
     */
    private $name;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User",
     *     mappedBy="roles")
     */
    private $users;


    /**
     * Role constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }


    /**
     * Get id*
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers(): ArrayCollection
    {

        return $this->users;
    }


    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }


    /**
     * Add a user to the role.
     * If user doesn't exist return false
     *
     * @param User $user
     * @return bool
     */
    public function addUser(User $user): bool {
        if ($this->users->contains($user)) {
            return false;
        }

        $this->users->add($user);
        $user->addRole($this);

        return true;
    }

    /**
     * Removes a user from the role.
     * If the user doesn't exist - return false.
     *
     * @param User $user
     * @return bool
     */
    public function removeUser(User $user): bool {
        if (!$this->users->contains($user)) {
            return false;
        }

        $this->users->removeElement($user);
        $user->removeRole($this);

        return true;
    }

    /**
     * @return string
     */
    public function __toString(): string {
        return $this->getName();
    }


}

