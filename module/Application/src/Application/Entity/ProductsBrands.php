<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsBrands
 *
 * @ORM\Table(name="products_brands", indexes={@ORM\Index(name="codmarca", columns={"codmarca"})})
 * @ORM\Entity
 */
class ProductsBrands
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
     * @ORM\Column(name="codmarca", type="string", length=30, nullable=false)
     */
    private $codmarca;

    /**
     * @var string
     *
     * @ORM\Column(name="imgtb", type="string", length=100, nullable=false)
     */
    private $imgtb;

    /**
     * @var string
     *
     * @ORM\Column(name="imgbig", type="string", length=100, nullable=false)
     */
    private $imgbig;

    /**
     * @var string
     *
     * @ORM\Column(name="nomemarca", type="string", length=100, nullable=false)
     */
    private $nomemarca;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione_lang1", type="text", nullable=false)
     */
    private $descrizioneLang1;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione_lang2", type="text", nullable=false)
     */
    private $descrizioneLang2;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione_lang3", type="text", nullable=false)
     */
    private $descrizioneLang3;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione_lang4", type="text", nullable=false)
     */
    private $descrizioneLang4;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", nullable=false)
     */
    private $status = 'si';

    /**
     * @var integer
     *
     * @ORM\Column(name="posiz", type="integer", nullable=false)
     */
    private $posiz = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="urlweb", type="string", length=100, nullable=false)
     */
    private $urlweb;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set codmarca
     *
     * @param string $codmarca
     * @return ProductsBrands
     */
    public function setCodmarca($codmarca)
    {
        $this->codmarca = $codmarca;

        return $this;
    }

    /**
     * Get codmarca
     *
     * @return string 
     */
    public function getCodmarca()
    {
        return $this->codmarca;
    }

    /**
     * Set imgtb
     *
     * @param string $imgtb
     * @return ProductsBrands
     */
    public function setImgtb($imgtb)
    {
        $this->imgtb = $imgtb;

        return $this;
    }

    /**
     * Get imgtb
     *
     * @return string 
     */
    public function getImgtb()
    {
        return $this->imgtb;
    }

    /**
     * Set imgbig
     *
     * @param string $imgbig
     * @return ProductsBrands
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
     * Set nomemarca
     *
     * @param string $nomemarca
     * @return ProductsBrands
     */
    public function setNomemarca($nomemarca)
    {
        $this->nomemarca = $nomemarca;

        return $this;
    }

    /**
     * Get nomemarca
     *
     * @return string 
     */
    public function getNomemarca()
    {
        return $this->nomemarca;
    }

    /**
     * Set descrizioneLang1
     *
     * @param string $descrizioneLang1
     * @return ProductsBrands
     */
    public function setDescrizioneLang1($descrizioneLang1)
    {
        $this->descrizioneLang1 = $descrizioneLang1;

        return $this;
    }

    /**
     * Get descrizioneLang1
     *
     * @return string 
     */
    public function getDescrizioneLang1()
    {
        return $this->descrizioneLang1;
    }

    /**
     * Set descrizioneLang2
     *
     * @param string $descrizioneLang2
     * @return ProductsBrands
     */
    public function setDescrizioneLang2($descrizioneLang2)
    {
        $this->descrizioneLang2 = $descrizioneLang2;

        return $this;
    }

    /**
     * Get descrizioneLang2
     *
     * @return string 
     */
    public function getDescrizioneLang2()
    {
        return $this->descrizioneLang2;
    }

    /**
     * Set descrizioneLang3
     *
     * @param string $descrizioneLang3
     * @return ProductsBrands
     */
    public function setDescrizioneLang3($descrizioneLang3)
    {
        $this->descrizioneLang3 = $descrizioneLang3;

        return $this;
    }

    /**
     * Get descrizioneLang3
     *
     * @return string 
     */
    public function getDescrizioneLang3()
    {
        return $this->descrizioneLang3;
    }

    /**
     * Set descrizioneLang4
     *
     * @param string $descrizioneLang4
     * @return ProductsBrands
     */
    public function setDescrizioneLang4($descrizioneLang4)
    {
        $this->descrizioneLang4 = $descrizioneLang4;

        return $this;
    }

    /**
     * Get descrizioneLang4
     *
     * @return string 
     */
    public function getDescrizioneLang4()
    {
        return $this->descrizioneLang4;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ProductsBrands
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
     * Set posiz
     *
     * @param integer $posiz
     * @return ProductsBrands
     */
    public function setPosiz($posiz)
    {
        $this->posiz = $posiz;

        return $this;
    }

    /**
     * Get posiz
     *
     * @return integer 
     */
    public function getPosiz()
    {
        return $this->posiz;
    }

    /**
     * Set urlweb
     *
     * @param string $urlweb
     * @return ProductsBrands
     */
    public function setUrlweb($urlweb)
    {
        $this->urlweb = $urlweb;

        return $this;
    }

    /**
     * Get urlweb
     *
     * @return string 
     */
    public function getUrlweb()
    {
        return $this->urlweb;
    }

    /**
     * Set seourl
     *
     * @param string $seourl
     * @return ProductsBrands
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
     * @return ProductsBrands
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
     * @return ProductsBrands
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
}
