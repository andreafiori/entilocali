<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Products
 *
 * @ORM\Table(name="products", indexes={@ORM\Index(name="searchprodfields", columns={"company_id", "category_id", "model_id", "user_id"})})
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
     * @ORM\Column(name="codprod", type="string", length=10, nullable=false)
     */
    private $codprod;

    /**
     * @var string
     *
     * @ORM\Column(name="codfornit", type="string", length=100, nullable=false)
     */
    private $codfornit;

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
     * @ORM\Column(name="imgbig", type="string", length=60, nullable=false)
     */
    private $imgbig;

    /**
     * @var string
     *
     * @ORM\Column(name="imgsmall", type="string", length=60, nullable=false)
     */
    private $imgsmall;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeprod", type="text", nullable=false)
     */
    private $nomeprod;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text", nullable=false)
     */
    private $descrizione;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=false)
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
     * @ORM\Column(name="disponibilita", type="integer", nullable=false)
     */
    private $disponibilita = '0';

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
     * @ORM\Column(name="brand", type="integer", nullable=false)
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
     * @ORM\Column(name="visibility", type="string", nullable=false)
     */
    private $visibility = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="posizprod", type="integer", nullable=false)
     */
    private $posizprod = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="seourl", type="string", length=100, nullable=false)
     */
    private $seourl;

    /**
     * @var string
     *
     * @ORM\Column(name="seokeyw", type="text", nullable=false)
     */
    private $seokeyw;

    /**
     * @var string
     *
     * @ORM\Column(name="seodescr", type="text", nullable=false)
     */
    private $seodescr;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="company_id", type="integer", nullable=false)
     */
    private $companyId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="model_id", type="integer", nullable=false)
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
     * Set codprod
     *
     * @param string $codprod
     * @return Products
     */
    public function setCodprod($codprod)
    {
        $this->codprod = $codprod;

        return $this;
    }

    /**
     * Get codprod
     *
     * @return string 
     */
    public function getCodprod()
    {
        return $this->codprod;
    }

    /**
     * Set codfornit
     *
     * @param string $codfornit
     * @return Products
     */
    public function setCodfornit($codfornit)
    {
        $this->codfornit = $codfornit;

        return $this;
    }

    /**
     * Get codfornit
     *
     * @return string 
     */
    public function getCodfornit()
    {
        return $this->codfornit;
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
     * Set imgbig
     *
     * @param string $imgbig
     * @return Products
     */
    public function setImgbig($imgbig)
    {
        $this->imgbig = $imgbig;

        return $this;
    }

    /**
     * Get imgbig
     *
     * @return string 
     */
    public function getImgbig()
    {
        return $this->imgbig;
    }

    /**
     * Set imgsmall
     *
     * @param string $imgsmall
     * @return Products
     */
    public function setImgsmall($imgsmall)
    {
        $this->imgsmall = $imgsmall;

        return $this;
    }

    /**
     * Get imgsmall
     *
     * @return string 
     */
    public function getImgsmall()
    {
        return $this->imgsmall;
    }

    /**
     * Set nomeprod
     *
     * @param string $nomeprod
     * @return Products
     */
    public function setNomeprod($nomeprod)
    {
        $this->nomeprod = $nomeprod;

        return $this;
    }

    /**
     * Get nomeprod
     *
     * @return string 
     */
    public function getNomeprod()
    {
        return $this->nomeprod;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     * @return Products
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string 
     */
    public function getDescrizione()
    {
        return $this->descrizione;
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
     * Set disponibilita
     *
     * @param integer $disponibilita
     * @return Products
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
     * Set visibility
     *
     * @param string $visibility
     * @return Products
     */
    public function setVisibility($visibility)
    {
        $this->visibility = $visibility;

        return $this;
    }

    /**
     * Get visibility
     *
     * @return string 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set posizprod
     *
     * @param integer $posizprod
     * @return Products
     */
    public function setPosizprod($posizprod)
    {
        $this->posizprod = $posizprod;

        return $this;
    }

    /**
     * Get posizprod
     *
     * @return integer 
     */
    public function getPosizprod()
    {
        return $this->posizprod;
    }

    /**
     * Set seourl
     *
     * @param string $seourl
     * @return Products
     */
    public function setSeourl($seourl)
    {
        $this->seourl = $seourl;

        return $this;
    }

    /**
     * Get seourl
     *
     * @return string 
     */
    public function getSeourl()
    {
        return $this->seourl;
    }

    /**
     * Set seokeyw
     *
     * @param string $seokeyw
     * @return Products
     */
    public function setSeokeyw($seokeyw)
    {
        $this->seokeyw = $seokeyw;

        return $this;
    }

    /**
     * Get seokeyw
     *
     * @return string 
     */
    public function getSeokeyw()
    {
        return $this->seokeyw;
    }

    /**
     * Set seodescr
     *
     * @param string $seodescr
     * @return Products
     */
    public function setSeodescr($seodescr)
    {
        $this->seodescr = $seodescr;

        return $this;
    }

    /**
     * Get seodescr
     *
     * @return string 
     */
    public function getSeodescr()
    {
        return $this->seodescr;
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
