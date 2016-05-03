<?php

namespace Oni\TravelPortBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroups
 *
 * @ORM\Table(name="oni_tc_user_groups")
 * @ORM\Entity(repositoryClass="Oni\TravelPortBundle\Entity\Repository\UserGroupsRepository")
 */
class UserGroups
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
     * @ORM\Column(name="GroupName", type="string", length=100)
     */
    private $groupName;

    /**
     * @var array
     *
     * @ORM\Column(name="Roles", type="array")
     */
    private $roles;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set groupName
     *
     * @param string $groupName
     *
     * @return UserGroups
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get groupName
     *
     * @return string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }


    /**
     * Set roles
     *
     * @param array $roles
     *
     * @return UserGroups
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Get roles
     *
     * @return array
     */
    public function getRoles()
    {
        return $this->roles;
    }
}

