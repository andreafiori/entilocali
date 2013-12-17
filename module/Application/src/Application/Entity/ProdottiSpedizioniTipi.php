<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProdottiSpedizioniTipi
 *
 * @ORM\Table(name="prodotti_spedizioni_tipi")
 * @ORM\Entity
 */
class ProdottiSpedizioniTipi
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
     * @ORM\Column(name="rifutenteazienda", type="string", length=50, nullable=true)
     */
    private $rifutenteazienda;



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
     * Set areadiconsegna
     *
     * @param string $areadiconsegna
     * @return ProdottiSpedizioniTipi
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
     * @return ProdottiSpedizioniTipi
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
     * @return ProdottiSpedizioniTipi
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
     * Set rifutenteazienda
     *
     * @param string $rifutenteazienda
     * @return ProdottiSpedizioniTipi
     */
    public function setRifutenteazienda($rifutenteazienda)
    {
        $this->rifutenteazienda = $rifutenteazienda;

        return $this;
    }

    /**
     * Get rifutenteazienda
     *
     * @return string 
     */
    public function getRifutenteazienda()
    {
        return $this->rifutenteazienda;
    }
}
