<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * qes
 *
 * @ORM\Table(name="qes")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\qesRepository")
 */
class qes
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
     * @var int
     *
     * @ORM\Column(name="userID", type="integer")
     */
    private $userID;

    /**
     * @var int
     *
     * @ORM\Column(name="dateSubmit", type="bigint")
     */
    private $dateSubmit;

    /**
     * @var string
     *
     * @ORM\Column(name="guid", type="string", length=255)
     */
    private $guid;

    /**
     * @var bool
     *
     * @ORM\Column(name="isStarter", type="boolean", nullable=true)
     */
    private $isStarter;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="des", type="text", nullable=true)
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
     * Set userID
     *
     * @param integer $userID
     *
     * @return qes
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get userID
     *
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set dateSubmit
     *
     * @param integer $dateSubmit
     *
     * @return qes
     */
    public function setDateSubmit($dateSubmit)
    {
        $this->dateSubmit = $dateSubmit;

        return $this;
    }

    /**
     * Get dateSubmit
     *
     * @return int
     */
    public function getDateSubmit()
    {
        return $this->dateSubmit;
    }

    /**
     * Set guid
     *
     * @param string $guid
     *
     * @return qes
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;

        return $this;
    }

    /**
     * Get guid
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Set isStarter
     *
     * @param boolean $isStarter
     *
     * @return qes
     */
    public function setIsStarter($isStarter)
    {
        $this->isStarter = $isStarter;

        return $this;
    }

    /**
     * Get isStarter
     *
     * @return bool
     */
    public function getIsStarter()
    {
        return $this->isStarter;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return qes
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set des
     *
     * @param string $des
     *
     * @return qes
     */
    public function setDes($des)
    {
        $this->des = $des;

        return $this;
    }

    /**
     * Get des
     *
     * @return string
     */
    public function getDes()
    {
        return $this->des;
    }
}

