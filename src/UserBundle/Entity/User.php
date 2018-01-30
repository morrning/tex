<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="sys_user")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Username;


    /**
     * @ORM\Column(type="string", length=100)
     */
    private $Password;

    /**
     * @ORM\Column(type="string", length=100,  nullable=true)
     */
    private $OnlineGUID;

    /**
     * @ORM\Column(type="string", length=100,  nullable=true)
     */
    private $imageID;

    /**
     * @ORM\Column(type="integer")
     */
    private $groupID;

    /**
     * @ORM\Column(type="integer")
     */
    private $tempID = 0;

    /**
     * Get id
     *
     * @return integer
     */

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->Username;
    }

    /**
     * @param mixed $Username
     */
    public function setUsername($Username)
    {
        $this->Username = $Username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * @param mixed $Password
     */
    public function setPassword($Password)
    {
        $this->Password = $Password;
    }

    /**
     * @return mixed
     */
    public function getOnlineGUID()
    {
        return $this->OnlineGUID;
    }

    /**
     * @param mixed $OnlineGUID
     */
    public function setOnlineGUID($OnlineGUID)
    {
        $this->OnlineGUID = $OnlineGUID;
    }

    /**
     * @return mixed
     */
    public function getImageID()
    {
        return $this->imageID;
    }

    /**
     * @param mixed $imageID
     */
    public function setImageID($imageID)
    {
        $this->imageID = $imageID;
    }

    /**
     * @return mixed
     */
    public function getGroupID()
    {
        return $this->groupID;
    }

    /**
     * @param mixed $groupID
     */
    public function setGroupID($groupID)
    {
        $this->groupID = $groupID;
    }

    /**
     * @return mixed
     */
    public function getTempID()
    {
        return $this->tempID;
    }

    /**
     * @param mixed $tempID
     */
    public function setTempID($tempID)
    {
        $this->tempID = $tempID;
    }


}

