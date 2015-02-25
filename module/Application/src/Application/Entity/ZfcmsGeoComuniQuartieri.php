<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsGeoComuniQuartieri
 *
 * @ORM\Table(name="zfcms_geo_comuni_quartieri", indexes={@ORM\Index(name="quartierisearch", columns={"nome"}), @ORM\Index(name="citta_id", columns={"citta_id"})})
 * @ORM\Entity
 */
class ZfcmsGeoComuniQuartieri
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
     * @ORM\Column(name="nome", type="string", length=50, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_principale", type="string", length=5, nullable=true)
     */
    private $capPrincipale;

    /**
     * @var \Application\Entity\ZfcmsGeoComuni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsGeoComuni")
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
     * @return ZfcmsGeoComuniQuartieri
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
     * Set capPrincipale
     *
     * @param string $capPrincipale
     * @return ZfcmsGeoComuniQuartieri
     */
    public function setCapPrincipale($capPrincipale)
    {
        $this->capPrincipale = $capPrincipale;
    
        return $this;
    }

    /**
     * Get capPrincipale
     *
     * @return string 
     */
    public function getCapPrincipale()
    {
        return $this->capPrincipale;
    }

    /**
     * Set citta
     *
     * @param \Application\Entity\ZfcmsGeoComuni $citta
     * @return ZfcmsGeoComuniQuartieri
     */
    public function setCitta(\Application\Entity\ZfcmsGeoComuni $citta = null)
    {
        $this->citta = $citta;
    
        return $this;
    }

    /**
     * Get citta
     *
     * @return \Application\Entity\ZfcmsGeoComuni 
     */
    public function getCitta()
    {
        return $this->citta;
    }
}
