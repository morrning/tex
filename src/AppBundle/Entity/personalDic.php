<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * personalDic
 *
 * @ORM\Table(name="personal_dic")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\personalDicRepository")
 */
class personalDic
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
     * @var string
     *
     * @ORM\Column(name="sourceWord", type="string", length=255)
     */
    private $sourceWord;

    /**
     * @var string
     *
     * @ORM\Column(name="transWord", type="string", length=255)
     */
    private $transWord;


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
     * @return personalDic
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
     * Set sourceWord
     *
     * @param string $sourceWord
     *
     * @return personalDic
     */
    public function setSourceWord($sourceWord)
    {
        $this->sourceWord = $sourceWord;

        return $this;
    }

    /**
     * Get sourceWord
     *
     * @return string
     */
    public function getSourceWord()
    {
        return $this->sourceWord;
    }

    /**
     * Set transWord
     *
     * @param string $transWord
     *
     * @return personalDic
     */
    public function setTransWord($transWord)
    {
        $this->transWord = $transWord;

        return $this;
    }

    /**
     * Get transWord
     *
     * @return string
     */
    public function getTransWord()
    {
        return $this->transWord;
    }
}

