<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuniQuartieri
 *
 * @ORM\Table(name="geo_comuni_quartieri", indexes={@ORM\Index(name="quartierisearch", columns={"nomequartiere"}), @ORM\Index(name="citta_id", columns={"citta_id"})})
 * @ORM\Entity
 */
class GeoComuniQuartieri
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
     * @ORM\Column(name="nomequartiere", type="string", length=50, nullable=true)
     */
    private $nomequartiere;

    /**
     * @var string
     *
     * @ORM\Column(name="capmain", type="string", length=5, nullable=true)
     */
    private $capmain;

    /**
     * @var \Application\Entity\GeoComuni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\GeoComuni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="citta_id", referencedColumnName="id")
     * })
     */
    private $citta;



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
     * Set nomequartiere
     *
     * @param string $nomequartiere
     * @return GeoComuniQuartieri
     */
    public function setNomequartiere($nomequartiere)
    {
        $this->nomequartiere = $nomequartiere;

        return $this;
    }

    /**
     * Get nomequartiere
     *
     * @return string 
     */
    public function getNomequartiere()
    {
        return $this->nomequartiere;
    }

    /**
     * Set capmain
     *
     * @param string $capmain
     * @return GeoComuniQuartieri
     */
    public function setCapmain($capmain)
    {
        $this->capmain = $capmain;

        return $this;
    }

    /**
     * Get capmain
     *
     * @return string 
     */
    public function getCapmain()
    {
        return $this->capmain;
    }

    /**
     * Set citta
     *
     * @param \Application\Entity\GeoComuni $citta
     * @return GeoComuniQuartieri
     */
    public function setCitta(\Application\Entity\GeoComuni $citta = null)
    {
        $this->citta = $citta;

        return $this;
    }

    /**
     * Get citta
     *
     * @return \Application\Entity\GeoComuni 
     */
    public function getCitta()
    {
        return $this->citta;
    }
}
