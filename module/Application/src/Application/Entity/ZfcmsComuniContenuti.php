<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContenuti
 *
 * @ORM\Table(name="zfcms_comuni_contenuti", indexes={@ORM\Index(name="fk_contenuti_sottosezioni", columns={"sottosezione_id"}), @ORM\Index(name="fk_contenuti_users", columns={"utente_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniContenuti
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
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=false)
     */
    private $anno = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="bigint", nullable=false)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", length=16777215, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="sommario", type="text", length=16777215, nullable=false)
     */
    private $sommario;

    /**
     * @var string
     *
     * @ORM\Column(name="testo", type="text", length=65535, nullable=true)
     */
    private $testo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="datetime", nullable=false)
     */
    private $dataInserimento = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="datetime", nullable=false)
     */
    private $dataScadenza = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_invio_regione", type="datetime", nullable=false)
     */
    private $dataInvioRegione = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="home", type="integer", nullable=false)
     */
    private $home;

    /**
     * @var integer
     *
     * @ORM\Column(name="evidenza", type="integer", nullable=false)
     */
    private $evidenza;

    /**
     * @var integer
     *
     * @ORM\Column(name="rss", type="integer", nullable=false)
     */
    private $rss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="pub_albo_comune", type="datetime", nullable=false)
     */
    private $pubAlboComune = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_rettifica", type="datetime", nullable=false)
     */
    private $dataRettifica = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="text", length=16777215, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="tabella", type="text", length=16777215, nullable=true)
     */
    private $tabella;

    /**
     * @var integer
     *
     * @ORM\Column(name="check_atti", type="integer", nullable=true)
     */
    private $checkAtti;

    /**
     * @var integer
     *
     * @ORM\Column(name="annoammtrasp", type="integer", nullable=false)
     */
    private $annoammtrasp = '2015';

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=80, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=100, nullable=false)
     */
    private $seoDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=100, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var \Application\Entity\ZfcmsComuniSottosezioni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniSottosezioni")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sottosezione_id", referencedColumnName="id")
     * })
     */
    private $sottosezione;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="utente_id", referencedColumnName="id")
     * })
     */
    private $utente;



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
     * Set anno
     *
     * @param integer $anno
     * @return ZfcmsComuniContenuti
     */
    public function setAnno($anno)
    {
        $this->anno = $anno;
    
        return $this;
    }

    /**
     * Get anno
     *
     * @return integer 
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set numero
     *
     * @param integer $numero
     * @return ZfcmsComuniContenuti
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return ZfcmsComuniContenuti
     */
    public function setTitolo($titolo)
    {
        $this->titolo = $titolo;
    
        return $this;
    }

    /**
     * Get titolo
     *
     * @return string 
     */
    public function getTitolo()
    {
        return $this->titolo;
    }

    /**
     * Set sommario
     *
     * @param string $sommario
     * @return ZfcmsComuniContenuti
     */
    public function setSommario($sommario)
    {
        $this->sommario = $sommario;
    
        return $this;
    }

    /**
     * Get sommario
     *
     * @return string 
     */
    public function getSommario()
    {
        return $this->sommario;
    }

    /**
     * Set testo
     *
     * @param string $testo
     * @return ZfcmsComuniContenuti
     */
    public function setTesto($testo)
    {
        $this->testo = $testo;
    
        return $this;
    }

    /**
     * Get testo
     *
     * @return string 
     */
    public function getTesto()
    {
        return $this->testo;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     * @return ZfcmsComuniContenuti
     */
    public function setDataInserimento($dataInserimento)
    {
        $this->dataInserimento = $dataInserimento;
    
        return $this;
    }

    /**
     * Get dataInserimento
     *
     * @return \DateTime 
     */
    public function getDataInserimento()
    {
        return $this->dataInserimento;
    }

    /**
     * Set dataScadenza
     *
     * @param \DateTime $dataScadenza
     * @return ZfcmsComuniContenuti
     */
    public function setDataScadenza($dataScadenza)
    {
        $this->dataScadenza = $dataScadenza;
    
        return $this;
    }

    /**
     * Get dataScadenza
     *
     * @return \DateTime 
     */
    public function getDataScadenza()
    {
        return $this->dataScadenza;
    }

    /**
     * Set dataInvioRegione
     *
     * @param \DateTime $dataInvioRegione
     * @return ZfcmsComuniContenuti
     */
    public function setDataInvioRegione($dataInvioRegione)
    {
        $this->dataInvioRegione = $dataInvioRegione;
    
        return $this;
    }

    /**
     * Get dataInvioRegione
     *
     * @return \DateTime 
     */
    public function getDataInvioRegione()
    {
        return $this->dataInvioRegione;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     * @return ZfcmsComuniContenuti
     */
    public function setAttivo($attivo)
    {
        $this->attivo = $attivo;
    
        return $this;
    }

    /**
     * Get attivo
     *
     * @return integer 
     */
    public function getAttivo()
    {
        return $this->attivo;
    }

    /**
     * Set home
     *
     * @param integer $home
     * @return ZfcmsComuniContenuti
     */
    public function setHome($home)
    {
        $this->home = $home;
    
        return $this;
    }

    /**
     * Get home
     *
     * @return integer 
     */
    public function getHome()
    {
        return $this->home;
    }

    /**
     * Set evidenza
     *
     * @param integer $evidenza
     * @return ZfcmsComuniContenuti
     */
    public function setEvidenza($evidenza)
    {
        $this->evidenza = $evidenza;
    
        return $this;
    }

    /**
     * Get evidenza
     *
     * @return integer 
     */
    public function getEvidenza()
    {
        return $this->evidenza;
    }

    /**
     * Set rss
     *
     * @param integer $rss
     * @return ZfcmsComuniContenuti
     */
    public function setRss($rss)
    {
        $this->rss = $rss;
    
        return $this;
    }

    /**
     * Get rss
     *
     * @return integer 
     */
    public function getRss()
    {
        return $this->rss;
    }

    /**
     * Set pubAlboComune
     *
     * @param \DateTime $pubAlboComune
     * @return ZfcmsComuniContenuti
     */
    public function setPubAlboComune($pubAlboComune)
    {
        $this->pubAlboComune = $pubAlboComune;
    
        return $this;
    }

    /**
     * Get pubAlboComune
     *
     * @return \DateTime 
     */
    public function getPubAlboComune()
    {
        return $this->pubAlboComune;
    }

    /**
     * Set dataRettifica
     *
     * @param \DateTime $dataRettifica
     * @return ZfcmsComuniContenuti
     */
    public function setDataRettifica($dataRettifica)
    {
        $this->dataRettifica = $dataRettifica;
    
        return $this;
    }

    /**
     * Get dataRettifica
     *
     * @return \DateTime 
     */
    public function getDataRettifica()
    {
        return $this->dataRettifica;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return ZfcmsComuniContenuti
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set tabella
     *
     * @param string $tabella
     * @return ZfcmsComuniContenuti
     */
    public function setTabella($tabella)
    {
        $this->tabella = $tabella;
    
        return $this;
    }

    /**
     * Get tabella
     *
     * @return string 
     */
    public function getTabella()
    {
        return $this->tabella;
    }

    /**
     * Set checkAtti
     *
     * @param integer $checkAtti
     * @return ZfcmsComuniContenuti
     */
    public function setCheckAtti($checkAtti)
    {
        $this->checkAtti = $checkAtti;
    
        return $this;
    }

    /**
     * Get checkAtti
     *
     * @return integer 
     */
    public function getCheckAtti()
    {
        return $this->checkAtti;
    }

    /**
     * Set annoammtrasp
     *
     * @param integer $annoammtrasp
     * @return ZfcmsComuniContenuti
     */
    public function setAnnoammtrasp($annoammtrasp)
    {
        $this->annoammtrasp = $annoammtrasp;
    
        return $this;
    }

    /**
     * Get annoammtrasp
     *
     * @return integer 
     */
    public function getAnnoammtrasp()
    {
        return $this->annoammtrasp;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return ZfcmsComuniContenuti
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     * @return ZfcmsComuniContenuti
     */
    public function setSeoTitle($seoTitle)
    {
        $this->seoTitle = $seoTitle;
    
        return $this;
    }

    /**
     * Get seoTitle
     *
     * @return string 
     */
    public function getSeoTitle()
    {
        return $this->seoTitle;
    }

    /**
     * Set seoDescription
     *
     * @param string $seoDescription
     * @return ZfcmsComuniContenuti
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seoDescription = $seoDescription;
    
        return $this;
    }

    /**
     * Get seoDescription
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seoDescription;
    }

    /**
     * Set seoKeywords
     *
     * @param string $seoKeywords
     * @return ZfcmsComuniContenuti
     */
    public function setSeoKeywords($seoKeywords)
    {
        $this->seoKeywords = $seoKeywords;
    
        return $this;
    }

    /**
     * Get seoKeywords
     *
     * @return string 
     */
    public function getSeoKeywords()
    {
        return $this->seoKeywords;
    }

    /**
     * Set sottosezione
     *
     * @param \Application\Entity\ZfcmsComuniSottosezioni $sottosezione
     * @return ZfcmsComuniContenuti
     */
    public function setSottosezione(\Application\Entity\ZfcmsComuniSottosezioni $sottosezione = null)
    {
        $this->sottosezione = $sottosezione;
    
        return $this;
    }

    /**
     * Get sottosezione
     *
     * @return \Application\Entity\ZfcmsComuniSottosezioni 
     */
    public function getSottosezione()
    {
        return $this->sottosezione;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     * @return ZfcmsComuniContenuti
     */
    public function setUtente(\Application\Entity\ZfcmsUsers $utente = null)
    {
        $this->utente = $utente;
    
        return $this;
    }

    /**
     * Get utente
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUtente()
    {
        return $this->utente;
    }
}
