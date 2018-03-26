<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserGroup
 *
 * @ORM\Table(name="sys_user_group")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserGroupRepository")
 */
class UserGroup
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
     * @ORM\Column(type="string", length=100)
     */
    private $groupName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $groupNameM;

    /**
     * @ORM\Column(type="string", length=254)
     */
    private $des;

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
     * @return mixed
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * @param mixed $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }

    /**
     * @return mixed
     */
    public function getDes()
    {
        return $this->des;
    }

    /**
     * @param mixed $des
     */
    public function setDes($des)
    {
        $this->des = $des;
    }

    /**
     * @return mixed
     */
    public function getGroupNameM()
    {
        return $this->groupNameM;
    }

    /**
     * @param mixed $groupNameM
     */
    public function setGroupNameM($groupNameM)
    {
        $this->groupNameM = $groupNameM;
    }


}

