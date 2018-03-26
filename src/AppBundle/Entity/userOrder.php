<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * userOrder
 *
 * @ORM\Table(name="user_order")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\userOrderRepository")
 */
class userOrder
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
     * @ORM\Column(name="field", type="string", length=255)
     */
    private $field;

    /**
     * @var string
     *
     * @ORM\Column(name="lang", type="string", length=255)
     */
    private $lang;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="dateTahvil", type="bigint")
     */
    private $dateTahvil;

    /**
     * @var string
     *
     * @ORM\Column(name="tableTrans", type="string", length=20)
     */
    private $tableTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="underTableTrans", type="string", length=20)
     */
    private $underTableTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="inImageTrans", type="string", length=20)
     */
    private $inImageTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="des", type="text", nullable=true)
     */
    private $des;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255, nullable=true)
     */
    private $file;

    /**
     * @var int
     *
     * @ORM\Column(name="dateSubmit", type="bigint")
     */
    private $dateSubmit;

    /**
     * @var string
     *
     * @ORM\Column(name="submitter", type="string", length=255)
     */
    private $submitter;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255)
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="bigint", nullable=true)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="translator", type="bigint", nullable=true)
     */
    private $translator;

    /**
     * @var int
     *
     * @ORM\Column(name="dateTahvilG", type="bigint", nullable=true)
     */
    private $dateTahvilG;


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
     * Set field
     *
     * @param string $field
     *
     * @return userOrder
     */
    public function setField($field)
    {
        $this->field = $field;

        return $this;
    }

    /**
     * Get field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Set lang
     *
     * @param string $lang
     *
     * @return userOrder
     */
    public function setLang($lang)
    {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return userOrder
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
     * Set dateTahvil
     *
     * @param integer $dateTahvil
     *
     * @return userOrder
     */
    public function setDateTahvil($dateTahvil)
    {
        $this->dateTahvil = $dateTahvil;

        return $this;
    }

    /**
     * Get dateTahvil
     *
     * @return int
     */
    public function getDateTahvil()
    {
        return $this->dateTahvil;
    }

    /**
     * Set tableTrans
     *
     * @param string $tableTrans
     *
     * @return userOrder
     */
    public function setTableTrans($tableTrans)
    {
        $this->tableTrans = $tableTrans;

        return $this;
    }

    /**
     * Get tableTrans
     *
     * @return string
     */
    public function getTableTrans()
    {
        return $this->tableTrans;
    }

    /**
     * Set underTableTrans
     *
     * @param string $underTableTrans
     *
     * @return userOrder
     */
    public function setUnderTableTrans($underTableTrans)
    {
        $this->underTableTrans = $underTableTrans;

        return $this;
    }

    /**
     * Get underTableTrans
     *
     * @return string
     */
    public function getUnderTableTrans()
    {
        return $this->underTableTrans;
    }

    /**
     * Set inImageTrans
     *
     * @param string $inImageTrans
     *
     * @return userOrder
     */
    public function setInImageTrans($inImageTrans)
    {
        $this->inImageTrans = $inImageTrans;

        return $this;
    }

    /**
     * Get inImageTrans
     *
     * @return string
     */
    public function getInImageTrans()
    {
        return $this->inImageTrans;
    }

    /**
     * Set des
     *
     * @param string $des
     *
     * @return userOrder
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

    /**
     * Set file
     *
     * @param string $file
     *
     * @return userOrder
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set dateSubmit
     *
     * @param integer $dateSubmit
     *
     * @return userOrder
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
     * Set submitter
     *
     * @param string $submitter
     *
     * @return userOrder
     */
    public function setSubmitter($submitter)
    {
        $this->submitter = $submitter;

        return $this;
    }

    /**
     * Get submitter
     *
     * @return string
     */
    public function getSubmitter()
    {
        return $this->submitter;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return userOrder
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return userOrder
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set translator
     *
     * @param integer $translator
     *
     * @return userOrder
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;

        return $this;
    }

    /**
     * Get translator
     *
     * @return int
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Set dateTahvilG
     *
     * @param integer $dateTahvilG
     *
     * @return userOrder
     */
    public function setDateTahvilG($dateTahvilG)
    {
        $this->dateTahvilG = $dateTahvilG;

        return $this;
    }

    /**
     * Get dateTahvilG
     *
     * @return int
     */
    public function getDateTahvilG()
    {
        return $this->dateTahvilG;
    }
}

