<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductsShipping
 *
 * @ORM\Table(name="products_shipping")
 * @ORM\Entity
 */
class ProductsShipping
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
     * @ORM\Column(name="nametype", type="string", length=100, nullable=true)
     */
    private $nametype;

    /**
     * @var string
     *
     * @ORM\Column(name="price_national", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceNational;

    /**
     * @var string
     *
     * @ORM\Column(name="price_euro", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceEuro;

    /**
     * @var string
     *
     * @ORM\Column(name="price_international", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $priceInternational;

    /**
     * @var string
     *
     * @ORM\Column(name="tempomedio", type="string", length=50, nullable=true)
     */
    private $tempomedio;



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
     * Set nametype
     *
     * @param string $nametype
     * @return ProductsShipping
     */
    public function setNametype($nametype)
    {
        $this->nametype = $nametype;

        return $this;
    }

    /**
     * Get nametype
     *
     * @return string 
     */
    public function getNametype()
    {
        return $this->nametype;
    }

    /**
     * Set priceNational
     *
     * @param string $priceNational
     * @return ProductsShipping
     */
    public function setPriceNational($priceNational)
    {
        $this->priceNational = $priceNational;

        return $this;
    }

    /**
     * Get priceNational
     *
     * @return string 
     */
    public function getPriceNational()
    {
        return $this->priceNational;
    }

    /**
     * Set priceEuro
     *
     * @param string $priceEuro
     * @return ProductsShipping
     */
    public function setPriceEuro($priceEuro)
    {
        $this->priceEuro = $priceEuro;

        return $this;
    }

    /**
     * Get priceEuro
     *
     * @return string 
     */
    public function getPriceEuro()
    {
        return $this->priceEuro;
    }

    /**
     * Set priceInternational
     *
     * @param string $priceInternational
     * @return ProductsShipping
     */
    public function setPriceInternational($priceInternational)
    {
        $this->priceInternational = $priceInternational;

        return $this;
    }

    /**
     * Get priceInternational
     *
     * @return string 
     */
    public function getPriceInternational()
    {
        return $this->priceInternational;
    }

    /**
     * Set tempomedio
     *
     * @param string $tempomedio
     * @return ProductsShipping
     */
    public function setTempomedio($tempomedio)
    {
        $this->tempomedio = $tempomedio;

        return $this;
    }

    /**
     * Get tempomedio
     *
     * @return string 
     */
    public function getTempomedio()
    {
        return $this->tempomedio;
    }
}
