<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuniQuartieri
 *
 * @ORM\Table(name="geo_comuni_quartieri", indexes={@ORM\Index(name="quartierisearch", columns={"nome"}), @ORM\Index(name="citta_id", columns={"citta_id"})})
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
     * @ORM\Column(name="nome", type="string", length=50, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_main", type="string", length=5, nullable=true)
     */
    private $capMain;

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
     * Set nome
     *
     * @param string $nome
     * @return GeoComuniQuartieri
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set capMain
     *
     * @param string $capMain
     * @return GeoComuniQuartieri
     */
    public function setCapMain($capMain)
    {
        $this->capMain = $capMain;

        return $this;
    }

    /**
     * Get capMain
     *
     * @return string 
     */
    public function getCapMain()
    {
        return $this->capMain;
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
