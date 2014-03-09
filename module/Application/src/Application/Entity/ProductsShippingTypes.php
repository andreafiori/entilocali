<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsShippingTypes
 *
 * @ORM\Table(name="products_shipping_types", indexes={@ORM\Index(name="usercompany_id", columns={"usercompany_id"})})
 * @ORM\Entity
 */
class ProductsShippingTypes
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
     * @ORM\Column(name="areadiconsegna", type="string", length=100, nullable=true)
     */
    private $areadiconsegna;

    /**
     * @var string
     *
     * @ORM\Column(name="ordineminimo", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $ordineminimo;

    /**
     * @var string
     *
     * @ORM\Column(name="tempomedioconsegna", type="string", length=50, nullable=true)
     */
    private $tempomedioconsegna;

    /**
     * @var string
     *
     * @ORM\Column(name="usercompany_id", type="string", length=50, nullable=true)
     */
    private $usercompanyId;



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
     * Set areadiconsegna
     *
     * @param string $areadiconsegna
     * @return ProductsShippingTypes
     */
    public function setAreadiconsegna($areadiconsegna)
    {
        $this->areadiconsegna = $areadiconsegna;

        return $this;
    }

    /**
     * Get areadiconsegna
     *
     * @return string 
     */
    public function getAreadiconsegna()
    {
        return $this->areadiconsegna;
    }

    /**
     * Set ordineminimo
     *
     * @param string $ordineminimo
     * @return ProductsShippingTypes
     */
    public function setOrdineminimo($ordineminimo)
    {
        $this->ordineminimo = $ordineminimo;

        return $this;
    }

    /**
     * Get ordineminimo
     *
     * @return string 
     */
    public function getOrdineminimo()
    {
        return $this->ordineminimo;
    }

    /**
     * Set tempomedioconsegna
     *
     * @param string $tempomedioconsegna
     * @return ProductsShippingTypes
     */
    public function setTempomedioconsegna($tempomedioconsegna)
    {
        $this->tempomedioconsegna = $tempomedioconsegna;

        return $this;
    }

    /**
     * Get tempomedioconsegna
     *
     * @return string 
     */
    public function getTempomedioconsegna()
    {
        return $this->tempomedioconsegna;
    }

    /**
     * Set usercompanyId
     *
     * @param string $usercompanyId
     * @return ProductsShippingTypes
     */
    public function setUsercompanyId($usercompanyId)
    {
        $this->usercompanyId = $usercompanyId;

        return $this;
    }

    /**
     * Get usercompanyId
     *
     * @return string 
     */
    public function getUsercompanyId()
    {
        return $this->usercompanyId;
    }
}
