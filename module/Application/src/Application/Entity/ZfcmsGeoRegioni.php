<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsGeoRegioni
 *
 * @ORM\Table(name="zfcms_geo_regioni", indexes={@ORM\Index(name="cod_regione", columns={"codice_regione"})})
 * @ORM\Entity
 */
class ZfcmsGeoRegioni
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
     * @ORM\Column(name="codice_regione", type="string", length=2, nullable=false)
     */
    private $codiceRegione;

    /**
     * @var string
     *
     * @ORM\Column(name="nome_regione", type="string", length=100, nullable=false)
     */
    private $nomeRegione;



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
     * Set codiceRegione
     *
     * @param string $codiceRegione
     * @return ZfcmsGeoRegioni
     */
    public function setCodiceRegione($codiceRegione)
    {
        $this->codiceRegione = $codiceRegione;
    
        return $this;
    }

    /**
     * Get codiceRegione
     *
     * @return string 
     */
    public function getCodiceRegione()
    {
        return $this->codiceRegione;
    }

    /**
     * Set nomeRegione
     *
     * @param string $nomeRegione
     * @return ZfcmsGeoRegioni
     */
    public function setNomeRegione($nomeRegione)
    {
        $this->nomeRegione = $nomeRegione;
    
        return $this;
    }

    /**
     * Get nomeRegione
     *
     * @return string 
     */
    public function getNomeRegione()
    {
        return $this->nomeRegione;
    }
}
