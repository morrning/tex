<?php

namespace paymentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * gateways
 *
 * @ORM\Table(name="gateways")
 * @ORM\Entity(repositoryClass="paymentBundle\Repository\gatewaysRepository")
 */
class gateways
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
     * @ORM\Column(name="gname", type="string", length=255)
     */
    private $gname;

    /**
     * @var string
     *
     * @ORM\Column(name="isActive", type="integer")
     */
    private $isActive;

    /**
     * @var string
     *
     * @ORM\Column(name="publicKey", type="string", length=255)
     */
    private $publicKey;

    /**
     * @var string
     *
     * @ORM\Column(name="privateKey", type="string", length=255)
     */
    private $privateKey;

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
     * Set gname
     *
     * @param string $gname
     *
     * @return gateways
     */
    public function setGname($gname)
    {
        $this->gname = $gname;

        return $this;
    }

    /**
     * Get gname
     *
     * @return string
     */
    public function getGname()
    {
        return $this->gname;
    }

    /**
     * @return string
     */
    public function getisActive()
    {
        return $this->isActive;
    }

    /**
     * @param string $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * @param string $publicKey
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @param string $privateKey
     */
    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return string
     */
    public function getDes()
    {
        return $this->des;
    }

    /**
     * @param string $des
     */
    public function setDes($des)
    {
        $this->des = $des;
    }


}

