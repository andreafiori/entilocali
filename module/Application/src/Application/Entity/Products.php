<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="searchprodfields", columns={"company_id", "category_id", "model_id", "user_id"}), @ORM\Index(name="codprod", columns={"code"}), @ORM\Index(name="codfornit", columns={"code_fornitore"})})
 * @ORM\Entity
 */
class Products
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="code_fornitore", type="string", length=100, nullable=false)
     */
    private $codeFornitore;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate = '2013-01-01 01:01:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="datetime", nullable=false)
     */
    private $expiredate = '2013-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="image_big", type="string", length=60, nullable=false)
     */
    private $imageBig;

    /**
     * @var string
     *
     * @ORM\Column(name="image_thumb", type="string", length=60, nullable=false)
     */
    private $imageThumb;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="descrption", type="text", nullable=false)
     */
    private $descrption;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="bigint", nullable=false)
     */
    private $amount = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $price = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="availability", type="bigint", nullable=false)
     */
    private $availability = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="iva", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $iva = '15';

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $discount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="shipping", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $shipping = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="brand", type="bigint", nullable=false)
     */
    private $brand = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=false)
     */
    private $position = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=100, nullable=false)
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="text", nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", nullable=false)
     */
    private $seoDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="bigint", nullable=false)
     */
    private $companyId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="bigint", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="model_id", type="bigint", nullable=false)
     */
    private $modelId = '0';



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
     * Set code
     *
     * @param string $code
     * @return Products
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
     * Set codeFornitore
     *
     * @param string $codeFornitore
     * @return Products
     */
    public function setCodeFornitore($codeFornitore)
    {
        $this->codeFornitore = $codeFornitore;

        return $this;
    }

    /**
     * Get codeFornitore
     *
     * @return string 
     */
    public function getCodeFornitore()
    {
        return $this->codeFornitore;
    }

    /**
     * Set insertdate
     *
     * @param \DateTime $insertdate
     * @return Products
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
     * @return Products
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
     * Set imageBig
     *
     * @param string $imageBig
     * @return Products
     */
    public function setImageBig($imageBig)
    {
        $this->imageBig = $imageBig;

        return $this;
    }

    /**
     * Get imageBig
     *
     * @return string 
     */
    public function getImageBig()
    {
        return $this->imageBig;
    }

    /**
     * Set imageThumb
     *
     * @param string $imageThumb
     * @return Products
     */
    public function setImageThumb($imageThumb)
    {
        $this->imageThumb = $imageThumb;

        return $this;
    }

    /**
     * Get imageThumb
     *
     * @return string 
     */
    public function getImageThumb()
    {
        return $this->imageThumb;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Products
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set descrption
     *
     * @param string $descrption
     * @return Products
     */
    public function setDescrption($descrption)
    {
        $this->descrption = $descrption;

        return $this;
    }

    /**
     * Get descrption
     *
     * @return string 
     */
    public function getDescrption()
    {
        return $this->descrption;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return Products
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
     * Set price
     *
     * @param string $price
     * @return Products
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
     * Set availability
     *
     * @param integer $availability
     * @return Products
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return integer 
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set iva
     *
     * @param string $iva
     * @return Products
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return string 
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set discount
     *
     * @param string $discount
     * @return Products
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set shipping
     *
     * @param string $shipping
     * @return Products
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;

        return $this;
    }

    /**
     * Get shipping
     *
     * @return string 
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * Set brand
     *
     * @param integer $brand
     * @return Products
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return integer 
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Products
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Products
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
     * Set position
     *
     * @param integer $position
     * @return Products
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set seoUrl
     *
     * @param string $seoUrl
     * @return Products
     */
    public function setSeoUrl($seoUrl)
    {
        $this->seoUrl = $seoUrl;

        return $this;
    }

    /**
     * Get seoUrl
     *
     * @return string 
     */
    public function getSeoUrl()
    {
        return $this->seoUrl;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return Products
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;

        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string 
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return Products
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;

        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Products
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
     * Set companyId
     *
     * @param integer $companyId
     * @return Products
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Products
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set modelId
     *
     * @param integer $modelId
     * @return Products
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;

        return $this;
    }

    /**
     * Get modelId
     *
     * @return integer 
     */
    public function getModelId()
    {
        return $this->modelId;
    }
}
