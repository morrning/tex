<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * setting
 *
 * @ORM\Table(name="setting")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\settingRepository")
 */
class setting
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
     * @var bool
     *
     * @ORM\Column(name="siteOffline", type="boolean", nullable=true)
     */
    private $siteOffline;

    /**
     * @var string
     *
     * @ORM\Column(name="terms", type="text", nullable=true)
     */
    private $terms;

    /**
     * @var string
     *
     * @ORM\Column(name="connectUs", type="text", nullable=true)
     */
    private $connectUs;

    /**
     * @var string
     *
     * @ORM\Column(name="about", type="text", nullable=true)
     */
    private $about;


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
     * Set siteOffline
     *
     * @param boolean $siteOffline
     *
     * @return setting
     */
    public function setSiteOffline($siteOffline)
    {
        $this->siteOffline = $siteOffline;

        return $this;
    }

    /**
     * Get siteOffline
     *
     * @return bool
     */
    public function getSiteOffline()
    {
        return $this->siteOffline;
    }

    /**
     * Set terms
     *
     * @param string $terms
     *
     * @return setting
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;

        return $this;
    }

    /**
     * Get terms
     *
     * @return string
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * Set connectUs
     *
     * @param string $connectUs
     *
     * @return setting
     */
    public function setConnectUs($connectUs)
    {
        $this->connectUs = $connectUs;

        return $this;
    }

    /**
     * Get connectUs
     *
     * @return string
     */
    public function getConnectUs()
    {
        return $this->connectUs;
    }

    /**
     * Set about
     *
     * @param string $about
     *
     * @return setting
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }

    /**
     * Get about
     *
     * @return string
     */
    public function getAbout()
    {
        return $this->about;
    }
}

