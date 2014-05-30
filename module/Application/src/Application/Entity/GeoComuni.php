<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuni
 *
 * @ORM\Table(name="geo_comuni", indexes={@ORM\Index(name="searchfields", columns={"cod_regione", "cod_provincia", "cod_comune", "nome_comune"})})
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
     * @ORM\Column(name="nome_comune", type="string", length=35, nullable=true)
     */
    private $nomeComune;

    /**
     * @var string
     *
     * @ORM\Column(name="codice_istat", type="string", length=9, nullable=true)
     */
    private $codiceIstat;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_principale", type="string", length=9, nullable=true)
     */
    private $capPrincipale;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_inizio", type="string", length=5, nullable=true)
     */
    private $capInizio;

    /**
     * @var string
     *
     * @ORM\Column(name="cap_fine", type="string", length=5, nullable=true)
     */
    private $capFine;

    /**
     * @var string
     *
     * @ORM\Column(name="prefisso", type="string", length=9, nullable=true)
     */
    private $prefisso;

    /**
     * @var string
     *
     * @ORM\Column(name="sito_web", type="string", length=50, nullable=true)
     */
    private $sitoWeb;

    /**
     * @var string
     *
     * @ORM\Column(name="latitudine", type="string", length=18, nullable=true)
     */
    private $latitudine;

    /**
     * @var string
     *
     * @ORM\Column(name="longitudine", type="string", length=18, nullable=true)
     */
    private $longitudine;



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
     *
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
     *
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
     *
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
     * Set nomeComune
     *
     * @param string $nomeComune
     *
     * @return GeoComuni
     */
    public function setNomeComune($nomeComune)
    {
        $this->nomeComune = $nomeComune;
    
        return $this;
    }

    /**
     * Get nomeComune
     *
     * @return string
     */
    public function getNomeComune()
    {
        return $this->nomeComune;
    }

    /**
     * Set codiceIstat
     *
     * @param string $codiceIstat
     *
     * @return GeoComuni
     */
    public function setCodiceIstat($codiceIstat)
    {
        $this->codiceIstat = $codiceIstat;
    
        return $this;
    }

    /**
     * Get codiceIstat
     *
     * @return string
     */
    public function getCodiceIstat()
    {
        return $this->codiceIstat;
    }

    /**
     * Set capPrincipale
     *
     * @param string $capPrincipale
     *
     * @return GeoComuni
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
     * Set capInizio
     *
     * @param string $capInizio
     *
     * @return GeoComuni
     */
    public function setCapInizio($capInizio)
    {
        $this->capInizio = $capInizio;
    
        return $this;
    }

    /**
     * Get capInizio
     *
     * @return string
     */
    public function getCapInizio()
    {
        return $this->capInizio;
    }

    /**
     * Set capFine
     *
     * @param string $capFine
     *
     * @return GeoComuni
     */
    public function setCapFine($capFine)
    {
        $this->capFine = $capFine;
    
        return $this;
    }

    /**
     * Get capFine
     *
     * @return string
     */
    public function getCapFine()
    {
        return $this->capFine;
    }

    /**
     * Set prefisso
     *
     * @param string $prefisso
     *
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
     * Set sitoWeb
     *
     * @param string $sitoWeb
     *
     * @return GeoComuni
     */
    public function setSitoWeb($sitoWeb)
    {
        $this->sitoWeb = $sitoWeb;
    
        return $this;
    }

    /**
     * Get sitoWeb
     *
     * @return string
     */
    public function getSitoWeb()
    {
        return $this->sitoWeb;
    }

    /**
     * Set latitudine
     *
     * @param string $latitudine
     *
     * @return GeoComuni
     */
    public function setLatitudine($latitudine)
    {
        $this->latitudine = $latitudine;
    
        return $this;
    }

    /**
     * Get latitudine
     *
     * @return string
     */
    public function getLatitudine()
    {
        return $this->latitudine;
    }

    /**
     * Set longitudine
     *
     * @param string $longitudine
     *
     * @return GeoComuni
     */
    public function setLongitudine($longitudine)
    {
        $this->longitudine = $longitudine;
    
        return $this;
    }

    /**
     * Get longitudine
     *
     * @return string
     */
    public function getLongitudine()
    {
        return $this->longitudine;
    }
}
