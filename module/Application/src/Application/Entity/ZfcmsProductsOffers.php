<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsOffers
 *
 * @ORM\Table(name="zfcms_products_offers")
 * @ORM\Entity
 */
class ZfcmsProductsOffers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="offer_date", type="datetime", nullable=false)
     */
    private $offerDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=false)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     */
    private $companyId;

    /**
     * @var string
     *
     * @ORM\Column(name="price_offer", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $priceOffer;

    /**
     * @var integer
     *
     * @ORM\Column(name="qt", type="integer", nullable=false)
     */
    private $qt;

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="bigint", nullable=false)
     */
    private $productId;



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
     * Set offerDate
     *
     * @param \DateTime $offerDate
     * @return ZfcmsProductsOffers
     */
    public function setOfferDate($offerDate)
    {
        $this->offerDate = $offerDate;
    
        return $this;
    }

    /**
     * Get offerDate
     *
     * @return \DateTime 
     */
    public function getOfferDate()
    {
        return $this->offerDate;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return ZfcmsProductsOffers
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    
        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime 
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ZfcmsProductsOffers
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
     * Set companyId
     *
     * @param integer $companyId
     * @return ZfcmsProductsOffers
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;
    
        return $this;
    }

    /**
     * Get companyId
     *
     * @return integer 
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * Set priceOffer
     *
     * @param string $priceOffer
     * @return ZfcmsProductsOffers
     */
    public function setPriceOffer($priceOffer)
    {
        $this->priceOffer = $priceOffer;
    
        return $this;
    }

    /**
     * Get priceOffer
     *
     * @return string 
     */
    public function getPriceOffer()
    {
        return $this->priceOffer;
    }

    /**
     * Set qt
     *
     * @param integer $qt
     * @return ZfcmsProductsOffers
     */
    public function setQt($qt)
    {
        $this->qt = $qt;
    
        return $this;
    }

    /**
     * Get qt
     *
     * @return integer 
     */
    public function getQt()
    {
        return $this->qt;
    }

    /**
     * Set productId
     *
     * @param integer $productId
     * @return ZfcmsProductsOffers
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
}
