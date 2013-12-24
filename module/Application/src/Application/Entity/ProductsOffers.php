<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsOffers
 *
 * @ORM\Table(name="products_offers", indexes={@ORM\Index(name="product_id", columns={"product_id"}), @ORM\Index(name="company_id", columns={"company_id"})})
 * @ORM\Entity
 */
class ProductsOffers
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
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate = '2008-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="datetime", nullable=false)
     */
    private $expiredate = '2008-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="scadenzattiva", type="string", nullable=false)
     */
    private $scadenzattiva = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="price_offer", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $priceOffer = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     */
    private $companyId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="product_id", type="integer", nullable=false)
     */
    private $productId = '0';



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
     * Set insertdate
     *
     * @param \DateTime $insertdate
     * @return ProductsOffers
     */
    public function setInsertdate($insertdate)
    {
        $this->insertdate = $insertdate;

        return $this;
    }

    /**
     * Get insertdate
     *
     * @return \DateTime 
     */
    public function getInsertdate()
    {
        return $this->insertdate;
    }

    /**
     * Set expiredate
     *
     * @param \DateTime $expiredate
     * @return ProductsOffers
     */
    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;

        return $this;
    }

    /**
     * Get expiredate
     *
     * @return \DateTime 
     */
    public function getExpiredate()
    {
        return $this->expiredate;
    }

    /**
     * Set scadenzattiva
     *
     * @param string $scadenzattiva
     * @return ProductsOffers
     */
    public function setScadenzattiva($scadenzattiva)
    {
        $this->scadenzattiva = $scadenzattiva;

        return $this;
    }

    /**
     * Get scadenzattiva
     *
     * @return string 
     */
    public function getScadenzattiva()
    {
        return $this->scadenzattiva;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ProductsOffers
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
     * Set priceOffer
     *
     * @param string $priceOffer
     * @return ProductsOffers
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
     * Set amount
     *
     * @param integer $amount
     * @return ProductsOffers
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set companyId
     *
     * @param integer $companyId
     * @return ProductsOffers
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
     * Set productId
     *
     * @param integer $productId
     * @return ProductsOffers
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
