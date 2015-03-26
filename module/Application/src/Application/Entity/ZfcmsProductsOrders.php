<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsOrders
 *
 * @ORM\Table(name="zfcms_products_orders")
 * @ORM\Entity
 */
class ZfcmsProductsOrders
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
    private $number;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="qt", type="string", length=10, nullable=false)
     */
    private $qt;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="datetime", nullable=false)
     */
    private $orderDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     */
    private $productId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_format", type="string", length=100, nullable=false)
     */
    private $paymentFormat;



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
     * Set number
     *
     * @param integer $number
     * @return ZfcmsProductsOrders
     */
    public function setNumber($number)
    {
        $this->number = $number;
    
        return $this;
    }

    /**
     * Get number
     *
     * @return integer 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return ZfcmsProductsOrders
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set qt
     *
     * @param string $qt
     * @return ZfcmsProductsOrders
     */
    public function setQt($qt)
    {
        $this->qt = $qt;
    
        return $this;
    }

    /**
     * Get qt
     *
     * @return string 
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return ZfcmsProductsOrders
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     * @return ZfcmsProductsOrders
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
    
        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime 
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return ZfcmsProductsOrders
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
    
        return $this;
    }

    /**
     * Get productId
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ZfcmsProductsOrders
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ZfcmsProductsOrders
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set paymentFormat
     *
     * @param string $paymentFormat
     * @return ZfcmsProductsOrders
     */
    public function setPaymentFormat($paymentFormat)
    {
        $this->paymentFormat = $paymentFormat;
    
        return $this;
    }

    /**
     * Get paymentFormat
     *
     * @return string 
     */
    public function getPaymentFormat()
    {
        return $this->paymentFormat;
    }
}
