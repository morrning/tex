<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * factor
 *
 * @ORM\Table(name="factor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\factorRepository")
 */
class factor
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
     * @ORM\Column(name="orderID", type="integer")
     */
    private $orderID;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="payed", type="boolean", nullable=true)
     */
    private $payed;

    /**
     * @var string
     *
     * @ORM\Column(name="paymentGatway", type="string", length=255)
     */
    private $paymentGatway;

    /**
     * @var string
     *
     * @ORM\Column(name="supportID", type="string", length=255)
     */
    private $supportID;

    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer")
     */
    private $userID;

    /**
     * @var string
     *
     * @ORM\Column(name="dateSubmit", type="string", length=255)
     */
    private $dateSubmit;

    /**
     * @var string
     *
     * @ORM\Column(name="datePay", type="string", length=255, nullable=true)
     */
    private $datePay;


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
     * Set orderID
     *
     * @param integer $orderID
     *
     * @return factor
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;

        return $this;
    }

    /**
     * Get orderID
     *
     * @return int
     */
    public function getOrderID()
    {
        return $this->orderID;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return factor
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
     * Set payed
     *
     * @param boolean $payed
     *
     * @return factor
     */
    public function setPayed($payed)
    {
        $this->payed = $payed;

        return $this;
    }

    /**
     * Get payed
     *
     * @return bool
     */
    public function getPayed()
    {
        return $this->payed;
    }

    /**
     * Set paymentGatway
     *
     * @param string $paymentGatway
     *
     * @return factor
     */
    public function setPaymentGatway($paymentGatway)
    {
        $this->paymentGatway = $paymentGatway;

        return $this;
    }

    /**
     * Get paymentGatway
     *
     * @return string
     */
    public function getPaymentGatway()
    {
        return $this->paymentGatway;
    }

    /**
     * Set supportID
     *
     * @param string $supportID
     *
     * @return factor
     */
    public function setSupportID($supportID)
    {
        $this->supportID = $supportID;

        return $this;
    }

    /**
     * Get supportID
     *
     * @return string
     */
    public function getSupportID()
    {
        return $this->supportID;
    }

    /**
     * Set userID
     *
     * @param integer $userID
     *
     * @return factor
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
     * @param string $dateSubmit
     *
     * @return factor
     */
    public function setDateSubmit($dateSubmit)
    {
        $this->dateSubmit = $dateSubmit;

        return $this;
    }

    /**
     * Get dateSubmit
     *
     * @return string
     */
    public function getDateSubmit()
    {
        return $this->dateSubmit;
    }

    /**
     * Set datePay
     *
     * @param string $datePay
     *
     * @return factor
     */
    public function setDatePay($datePay)
    {
        $this->datePay = $datePay;

        return $this;
    }

    /**
     * Get datePay
     *
     * @return string
     */
    public function getDatePay()
    {
        return $this->datePay;
    }
}

