<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * transLang
 *
 * @ORM\Table(name="trans_lang")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\transLangRepository")
 */
class transLang
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
     * @ORM\Column(name="transName", type="string", length=255)
     */
    private $transName;


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
     * Set transName
     *
     * @param string $transName
     *
     * @return transLang
     */
    public function setTransName($transName)
    {
        $this->transName = $transName;

        return $this;
    }

    /**
     * Get transName
     *
     * @return string
     */
    public function getTransName()
    {
        return $this->transName;
    }
}

