<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsProductsBrands
 *
 * @ORM\Table(name="zfcms_products_brands")
 * @ORM\Entity
 */
class ZfcmsProductsBrands
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
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=30, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="image_thumb", type="string", length=100, nullable=false)
     */
    private $imageThumb;

    /**
     * @var string
     *
     * @ORM\Column(name="image_big", type="string", length=100, nullable=false)
     */
    private $imageBig;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

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
     * @ORM\Column(name="url_web", type="string", length=100, nullable=false)
     */
    private $urlWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_url", type="string", length=100, nullable=false)
     */
    private $seoUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keyw", type="text", length=65535, nullable=false)
     */
    private $seoKeyw;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="text", length=65535, nullable=false)
     */
    private $seoDescription;



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
     * @return ZfcmsProductsBrands
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
     * Set imageThumb
     *
     * @param string $imageThumb
     * @return ZfcmsProductsBrands
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
     * @return ZfcmsProductsBrands
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
     * Set name
     *
     * @param string $name
     * @return ZfcmsProductsBrands
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
     * @return ZfcmsProductsBrands
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
     * Set status
     *
     * @param string $status
     * @return ZfcmsProductsBrands
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
     * @return ZfcmsProductsBrands
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
     * Set urlWeb
     *
     * @param string $urlWeb
     * @return ZfcmsProductsBrands
     */
    public function setUrlWeb($urlWeb)
    {
        $this->urlWeb = $urlWeb;
    
        return $this;
    }

    /**
     * Get urlWeb
     *
     * @return string 
     */
    public function getUrlWeb()
    {
        return $this->urlWeb;
    }

    /**
     * Set seoUrl
     *
     * @param string $seoUrl
     * @return ZfcmsProductsBrands
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
     * Set seoKeyw
     *
     * @param string $seoKeyw
     * @return ZfcmsProductsBrands
     */
    public function setSeoKeyw($seoKeyw)
    {
        $this->seoKeyw = $seoKeyw;
    
        return $this;
    }

    /**
     * Get seoKeyw
     *
     * @return string 
     */
    public function getSeoKeyw()
    {
        return $this->seoKeyw;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return ZfcmsProductsBrands
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
}
