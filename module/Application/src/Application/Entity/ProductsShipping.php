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
     * @ORM\Column(name="idsped", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idsped;

    /**
     * @var string
     *
     * @ORM\Column(name="nomesped", type="string", length=100, nullable=true)
     */
    private $nomesped;

    /**
     * @var string
     *
     * @ORM\Column(name="costonazionale", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costonazionale;

    /**
     * @var string
     *
     * @ORM\Column(name="costoeur", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costoeur;

    /**
     * @var string
     *
     * @ORM\Column(name="costointernaz", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $costointernaz;

    /**
     * @var string
     *
     * @ORM\Column(name="tempomedio", type="string", length=50, nullable=true)
     */
    private $tempomedio;



    /**
     * Get idsped
     *
     * @return integer 
     */
    public function getIdsped()
    {
        return $this->idsped;
    }

    /**
     * Set nomesped
     *
     * @param string $nomesped
     * @return ProductsShipping
     */
    public function setNomesped($nomesped)
    {
        $this->nomesped = $nomesped;

        return $this;
    }

    /**
     * Get nomesped
     *
     * @return string 
     */
    public function getNomesped()
    {
        return $this->nomesped;
    }

    /**
     * Set costonazionale
     *
     * @param string $costonazionale
     * @return ProductsShipping
     */
    public function setCostonazionale($costonazionale)
    {
        $this->costonazionale = $costonazionale;

        return $this;
    }

    /**
     * Get costonazionale
     *
     * @return string 
     */
    public function getCostonazionale()
    {
        return $this->costonazionale;
    }

    /**
     * Set costoeur
     *
     * @param string $costoeur
     * @return ProductsShipping
     */
    public function setCostoeur($costoeur)
    {
        $this->costoeur = $costoeur;

        return $this;
    }

    /**
     * Get costoeur
     *
     * @return string 
     */
    public function getCostoeur()
    {
        return $this->costoeur;
    }

    /**
     * Set costointernaz
     *
     * @param string $costointernaz
     * @return ProductsShipping
     */
    public function setCostointernaz($costointernaz)
    {
        $this->costointernaz = $costointernaz;

        return $this;
    }

    /**
     * Get costointernaz
     *
     * @return string 
     */
    public function getCostointernaz()
    {
        return $this->costointernaz;
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
