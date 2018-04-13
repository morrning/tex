<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @ORM\Column(name="dateCreate", type="bigint")
     */
    private $dateCreate;

    /**
     * @var bool
     *
     * @ORM\Column(name="paid", type="boolean", nullable=true)
     */
    private $paid;

    /**
     * @var bool
     *
     * @ORM\Column(name="paidText", type="string", length=255, nullable=true)
     */
    private $paidText;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="bigint")
     */
    private $amount;

    /**
     * @var int
     *
     * @ORM\Column(name="percent", type="bigint")
     */
    private $percent;

    /**
     * @var int
     *
     * @ORM\Column(name="orderID", type="integer")
     */
    private $orderID;

    /**
     * @var int
     *
     * @ORM\Column(name="datePay", type="bigint", nullable=true)
     */
    private $datePay;

    /**
     * @var string
     *
     * @ORM\Column(name="gatewayName", type="string", length=255, nullable=true)
     */
    private $gatewayName;

    /**
     * @var string
     *
     * @ORM\Column(name="payNum1", type="string", length=255, nullable=true)
     */
    private $payNum1;

    /**
     * @var string
     *
     * @ORM\Column(name="payNum2", type="string", length=255, nullable=true)
     */
    private $payNum2;

    /**
     * @var string
     *
     * @ORM\Column(name="des", type="string", length=255, nullable=true)
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
     * @return Transaction
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
     * Set dateCreate
     *
     * @param integer $dateCreate
     *
     * @return Transaction
     */
    public function setDateCreate($dateCreate)
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    /**
     * Get dateCreate
     *
     * @return int
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     *
     * @return Transaction
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return bool
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set percent
     *
     * @param integer $percent
     *
     * @return Transaction
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * Set orderID
     *
     * @param integer $orderID
     *
     * @return Transaction
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
     * Set datePay
     *
     * @param integer $datePay
     *
     * @return Transaction
     */
    public function setDatePay($datePay)
    {
        $this->datePay = $datePay;

        return $this;
    }

    /**
     * Get datePay
     *
     * @return int
     */
    public function getDatePay()
    {
        return $this->datePay;
    }

    /**
     * Set gatewayName
     *
     * @param string $gatewayName
     *
     * @return Transaction
     */
    public function setGatewayName($gatewayName)
    {
        $this->gatewayName = $gatewayName;

        return $this;
    }

    /**
     * Get gatewayName
     *
     * @return string
     */
    public function getGatewayName()
    {
        return $this->gatewayName;
    }

    /**
     * Set payNum1
     *
     * @param string $payNum1
     *
     * @return Transaction
     */
    public function setPayNum1($payNum1)
    {
        $this->payNum1 = $payNum1;

        return $this;
    }

    /**
     * Get payNum1
     *
     * @return string
     */
    public function getPayNum1()
    {
        return $this->payNum1;
    }

    /**
     * Set payNum2
     *
     * @param string $payNum2
     *
     * @return Transaction
     */
    public function setPayNum2($payNum2)
    {
        $this->payNum2 = $payNum2;

        return $this;
    }

    /**
     * Get payNum2
     *
     * @return string
     */
    public function getPayNum2()
    {
        return $this->payNum2;
    }

    /**
     * Set des
     *
     * @param string $des
     *
     * @return Transaction
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
     * @return bool
     */
    public function getPaidText()
    {
        return $this->paidText;
    }

    /**
     * @param bool $paidText
     */
    public function setPaidText($paidText)
    {
        $this->paidText = $paidText;
    }


}

