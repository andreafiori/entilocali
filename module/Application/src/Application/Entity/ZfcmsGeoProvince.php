<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsGeoProvince
 *
 * @ORM\Table(name="zfcms_geo_province", indexes={@ORM\Index(name="codice_provincia", columns={"codice_provincia"}), @ORM\Index(name="codice_regione", columns={"codice_regione"})})
 * @ORM\Entity
 */
class ZfcmsGeoProvince
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
     * @ORM\Column(name="codice_regione", type="string", length=14, nullable=true)
     */
    private $codiceRegione;

    /**
     * @var string
     *
     * @ORM\Column(name="codice_provincia", type="string", length=16, nullable=true)
     */
    private $codiceProvincia;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=28, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="sigla", type="string", length=21, nullable=true)
     */
    private $sigla;

    /**
     * @var string
     *
     * @ORM\Column(name="capoluogo", type="string", nullable=true)
     */
    private $capoluogo;



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
     *
     * @return ZfcmsGeoProvince
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
     * Set codiceProvincia
     *
     * @param string $codiceProvincia
     *
     * @return ZfcmsGeoProvince
     */
    public function setCodiceProvincia($codiceProvincia)
    {
        $this->codiceProvincia = $codiceProvincia;
    
        return $this;
    }

    /**
     * Get codiceProvincia
     *
     * @return string
     */
    public function getCodiceProvincia()
    {
        return $this->codiceProvincia;
    }

    /**
     * Set nome
     *
     * @param string $nome
     *
     * @return ZfcmsGeoProvince
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
     * Set sigla
     *
     * @param string $sigla
     *
     * @return ZfcmsGeoProvince
     */
    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    
        return $this;
    }

    /**
     * Get sigla
     *
     * @return string
     */
    public function getSigla()
    {
        return $this->sigla;
    }

    /**
     * Set capoluogo
     *
     * @param string $capoluogo
     *
     * @return ZfcmsGeoProvince
     */
    public function setCapoluogo($capoluogo)
    {
        $this->capoluogo = $capoluogo;
    
        return $this;
    }

    /**
     * Get capoluogo
     *
     * @return string
     */
    public function getCapoluogo()
    {
        return $this->capoluogo;
    }
}
