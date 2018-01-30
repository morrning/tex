<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permission
 *
 * @ORM\Table(name="sys_permission")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\PermissionRepository")
 */
class Permission
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
    private $bundle;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $permissionName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $PermissionTitle;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $options;


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
    public function getPermissionName()
    {
        return $this->permissionName;
    }

    /**
     * @param mixed $permissionName
     */
    public function setPermissionName($permissionName)
    {
        $this->permissionName = $permissionName;
    }

    /**
     * @return mixed
     */
    public function getPermissionTitle()
    {
        return $this->PermissionTitle;
    }

    /**
     * @param mixed $PermissionTitle
     */
    public function setPermissionTitle($PermissionTitle)
    {
        $this->PermissionTitle = $PermissionTitle;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    /**
     * @return mixed
     */
    public function getBundle()
    {
        return $this->bundle;
    }

    /**
     * @param mixed $bundle
     */
    public function setBundle($bundle)
    {
        $this->bundle = $bundle;
    }


}

