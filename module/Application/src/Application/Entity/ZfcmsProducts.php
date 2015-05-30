<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProducts
 *
 * @ORM\Table(name="zfcms_products")
 * @ORM\Entity
 */
class ZfcmsProducts
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
     * @ORM\Column(name="image_thumb", type="string", length=60, nullable=false)
     */
    private $imageThumb;

    /**
     * @var string
     *
     * @ORM\Column(name="image_big", type="string", length=60, nullable=false)
     */
    private $imageBig;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=10, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="code_seller", type="string", length=100, nullable=false)
     */
    private $codeSeller;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=false)
     */
    private $expireDate;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", length=65535, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=60, scale=2, nullable=false)
     */
    private $price;

    /**
     * @var integer
     *
     * @ORM\Column(name="disponibilita", type="integer", nullable=false)
     */
    private $disponibilita;

    /**
     * @var string
     *
     * @ORM\Column(name="iva", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $iva;

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="shipping", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $shipping;

    /**
     * @var integer
     *
     * @ORM\Column(name="marca", type="integer", nullable=false)
     */
    private $marca;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", length=65535, nullable=false)
     */
    private $note;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=100, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="text", length=65535, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", length=65535, nullable=false)
     */
    private $seoDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="model_id", type="integer", nullable=false)
     */
    private $modelId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="bigint", nullable=false)
     */
    private $companyId;



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
     * Set imageThumb
     *
     * @param string $imageThumb
     * @return ZfcmsProducts
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
     * Set imageBig
     *
     * @param string $imageBig
     * @return ZfcmsProducts
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
     * Set code
     *
     * @param string $code
     * @return ZfcmsProducts
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
     * Set codeSeller
     *
     * @param string $codeSeller
     * @return ZfcmsProducts
     */
    public function setCodeSeller($codeSeller)
    {
        $this->codeSeller = $codeSeller;
    
        return $this;
    }

    /**
     * Get codeSeller
     *
     * @return string 
     */
    public function getCodeSeller()
    {
        return $this->codeSeller;
    }

    /**
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return ZfcmsProducts
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return ZfcmsProducts
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
     * Set name
     *
     * @param string $name
     * @return ZfcmsProducts
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
     * Set description
     *
     * @param string $description
     * @return ZfcmsProducts
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * Set disponibilita
     *
     * @param integer $disponibilita
     * @return ZfcmsProducts
     */
    public function setDisponibilita($disponibilita)
    {
        $this->disponibilita = $disponibilita;
    
        return $this;
    }

    /**
     * Get disponibilita
     *
     * @return integer 
     */
    public function getDisponibilita()
    {
        return $this->disponibilita;
    }

    /**
     * Set iva
     *
     * @param string $iva
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * Set marca
     *
     * @param integer $marca
     * @return ZfcmsProducts
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;
    
        return $this;
    }

    /**
     * Get marca
     *
     * @return integer 
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return ZfcmsProducts
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
    
        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string 
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
     * Set modelId
     *
     * @param integer $modelId
     * @return ZfcmsProducts
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

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ZfcmsProducts
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
     * @return ZfcmsProducts
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
}
