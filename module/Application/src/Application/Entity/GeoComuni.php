<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuni
 *
 * @ORM\Table(name="geo_comuni", indexes={@ORM\Index(name="searchfields", columns={"cod_regione", "cod_provincia", "cod_comune", "nomecomune"})})
 * @ORM\Entity
 */
class GeoComuni
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
     * @ORM\Column(name="cod_regione", type="string", length=9, nullable=true)
     */
    private $codRegione;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_provincia", type="string", length=9, nullable=true)
     */
    private $codProvincia;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_comune", type="string", length=9, nullable=true)
     */
    private $codComune;

    /**
     * @var string
     *
     * @ORM\Column(name="nomecomune", type="string", length=35, nullable=true)
     */
    private $nomecomune;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_istat", type="string", length=9, nullable=true)
     */
    private $codIstat;

    /**
     * @var string
     *
     * @ORM\Column(name="capzip", type="string", length=9, nullable=true)
     */
    private $capzip;

    /**
     * @var string
     *
     * @ORM\Column(name="prefisso", type="string", length=9, nullable=true)
     */
    private $prefisso;

    /**
     * @var string
     *
     * @ORM\Column(name="urlweb", type="string", length=50, nullable=true)
     */
    private $urlweb;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=18, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=18, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="capinizio", type="string", length=5, nullable=true)
     */
    private $capinizio;

    /**
     * @var string
     *
     * @ORM\Column(name="capfine", type="string", length=5, nullable=true)
     */
    private $capfine;



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
     * Set codRegione
     *
     * @param string $codRegione
     * @return GeoComuni
     */
    public function setCodRegione($codRegione)
    {
        $this->codRegione = $codRegione;

        return $this;
    }

    /**
     * Get codRegione
     *
     * @return string 
     */
    public function getCodRegione()
    {
        return $this->codRegione;
    }

    /**
     * Set codProvincia
     *
     * @param string $codProvincia
     * @return GeoComuni
     */
    public function setCodProvincia($codProvincia)
    {
        $this->codProvincia = $codProvincia;

        return $this;
    }

    /**
     * Get codProvincia
     *
     * @return string 
     */
    public function getCodProvincia()
    {
        return $this->codProvincia;
    }

    /**
     * Set codComune
     *
     * @param string $codComune
     * @return GeoComuni
     */
    public function setCodComune($codComune)
    {
        $this->codComune = $codComune;

        return $this;
    }

    /**
     * Get codComune
     *
     * @return string 
     */
    public function getCodComune()
    {
        return $this->codComune;
    }

    /**
     * Set nomecomune
     *
     * @param string $nomecomune
     * @return GeoComuni
     */
    public function setNomecomune($nomecomune)
    {
        $this->nomecomune = $nomecomune;

        return $this;
    }

    /**
     * Get nomecomune
     *
     * @return string 
     */
    public function getNomecomune()
    {
        return $this->nomecomune;
    }

    /**
     * Set codIstat
     *
     * @param string $codIstat
     * @return GeoComuni
     */
    public function setCodIstat($codIstat)
    {
        $this->codIstat = $codIstat;

        return $this;
    }

    /**
     * Get codIstat
     *
     * @return string 
     */
    public function getCodIstat()
    {
        return $this->codIstat;
    }

    /**
     * Set capzip
     *
     * @param string $capzip
     * @return GeoComuni
     */
    public function setCapzip($capzip)
    {
        $this->capzip = $capzip;

        return $this;
    }

    /**
     * Get capzip
     *
     * @return string 
     */
    public function getCapzip()
    {
        return $this->capzip;
    }

    /**
     * Set prefisso
     *
     * @param string $prefisso
     * @return GeoComuni
     */
    public function setPrefisso($prefisso)
    {
        $this->prefisso = $prefisso;

        return $this;
    }

    /**
     * Get prefisso
     *
     * @return string 
     */
    public function getPrefisso()
    {
        return $this->prefisso;
    }

    /**
     * Set urlweb
     *
     * @param string $urlweb
     * @return GeoComuni
     */
    public function setUrlweb($urlweb)
    {
        $this->urlweb = $urlweb;

        return $this;
    }

    /**
     * Get urlweb
     *
     * @return string 
     */
    public function getUrlweb()
    {
        return $this->urlweb;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return GeoComuni
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return GeoComuni
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set capinizio
     *
     * @param string $capinizio
     * @return GeoComuni
     */
    public function setCapinizio($capinizio)
    {
        $this->capinizio = $capinizio;

        return $this;
    }

    /**
     * Get capinizio
     *
     * @return string 
     */
    public function getCapinizio()
    {
        return $this->capinizio;
    }

    /**
     * Set capfine
     *
     * @param string $capfine
     * @return GeoComuni
     */
    public function setCapfine($capfine)
    {
        $this->capfine = $capfine;

        return $this;
    }

    /**
     * Get capfine
     *
     * @return string 
     */
    public function getCapfine()
    {
        return $this->capfine;
    }
}
