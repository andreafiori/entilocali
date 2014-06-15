<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAlboAtti
 *
 * @ORM\Table(name="zfcms_albo_atti", indexes={@ORM\Index(name="user_id", columns={"utente_id"}), @ORM\Index(name="settore_id", columns={"settore_id"}), @ORM\Index(name="sezione_id", columns={"sezione_id"})})
 * @ORM\Entity
 */
class ZfcmsAlboAtti
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
     * @ORM\Column(name="numero", type="bigint", nullable=false)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="bigint", nullable=false)
     */
    private $anno;

    /**
     * @var string
     *
     * @ORM\Column(name="oggetto", type="text", length=65535, nullable=false)
     */
    private $oggetto;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text", length=65535, nullable=false)
     */
    private $descrizione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_richiesta", type="datetime", nullable=false)
     */
    private $dataRichiesta = '2012-01-01 01:01:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_pubblicazione", type="datetime", nullable=false)
     */
    private $dataPubblicazione = '2012-01-01 01:01:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="datetime", nullable=false)
     */
    private $dataScadenza = '2012-01-01 01:01:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_giorni_scadenza", type="bigint", nullable=false)
     */
    private $numeroGiorniScadenza = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="annullato", type="string", nullable=false)
     */
    private $annullato = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_annullamento", type="datetime", nullable=false)
     */
    private $dataAnnullamento = '2012-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="note_annullamento", type="text", length=65535, nullable=false)
     */
    private $noteAnnullamento;

    /**
     * @var string
     *
     * @ORM\Column(name="rettificato", type="string", nullable=false)
     */
    private $rettificato = 'no';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_rettifica", type="datetime", nullable=false)
     */
    private $dataRettifica = '2012-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="note_rettifica", type="text", length=65535, nullable=false)
     */
    private $noteRettifica;

    /**
     * @var string
     *
     * @ORM\Column(name="stato", type="string", length=50, nullable=false)
     */
    private $stato = 'si';

    /**
     * @var string
     *
     * @ORM\Column(name="inviato_regione", type="string", nullable=false)
     */
    private $inviatoRegione = 'no';

    /**
     * @var string
     *
     * @ORM\Column(name="ente_terzo", type="string", length=80, nullable=false)
     */
    private $enteTerzo;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_title", type="string", length=80, nullable=false)
     */
    private $seoTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_keywords", type="string", length=80, nullable=false)
     */
    private $seoKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="seo_description", type="string", length=150, nullable=false)
     */
    private $seoDescription;

    /**
     * @var \Application\Entity\ZfcmsAlboSettori
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsAlboSettori")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="settore_id", referencedColumnName="id")
     * })
     */
    private $settore;

    /**
     * @var \Application\Entity\ZfcmsAlboSettori
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsAlboSettori")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sezione_id", referencedColumnName="id")
     * })
     */
    private $sezione;

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
     * Set numero
     *
     * @param integer $numero
     *
     * @return ZfcmsAlboAtti
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
     * Set anno
     *
     * @param integer $anno
     *
     * @return ZfcmsAlboAtti
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
     * Set oggetto
     *
     * @param string $oggetto
     *
     * @return ZfcmsAlboAtti
     */
    public function setOggetto($oggetto)
    {
        $this->oggetto = $oggetto;
    
        return $this;
    }

    /**
     * Get oggetto
     *
     * @return string
     */
    public function getOggetto()
    {
        return $this->oggetto;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return ZfcmsAlboAtti
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    
        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set dataRichiesta
     *
     * @param \DateTime $dataRichiesta
     *
     * @return ZfcmsAlboAtti
     */
    public function setDataRichiesta($dataRichiesta)
    {
        $this->dataRichiesta = $dataRichiesta;
    
        return $this;
    }

    /**
     * Get dataRichiesta
     *
     * @return \DateTime
     */
    public function getDataRichiesta()
    {
        return $this->dataRichiesta;
    }

    /**
     * Set dataPubblicazione
     *
     * @param \DateTime $dataPubblicazione
     *
     * @return ZfcmsAlboAtti
     */
    public function setDataPubblicazione($dataPubblicazione)
    {
        $this->dataPubblicazione = $dataPubblicazione;
    
        return $this;
    }

    /**
     * Get dataPubblicazione
     *
     * @return \DateTime
     */
    public function getDataPubblicazione()
    {
        return $this->dataPubblicazione;
    }

    /**
     * Set dataScadenza
     *
     * @param \DateTime $dataScadenza
     *
     * @return ZfcmsAlboAtti
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
     * Set numeroGiorniScadenza
     *
     * @param integer $numeroGiorniScadenza
     *
     * @return ZfcmsAlboAtti
     */
    public function setNumeroGiorniScadenza($numeroGiorniScadenza)
    {
        $this->numeroGiorniScadenza = $numeroGiorniScadenza;
    
        return $this;
    }

    /**
     * Get numeroGiorniScadenza
     *
     * @return integer
     */
    public function getNumeroGiorniScadenza()
    {
        return $this->numeroGiorniScadenza;
    }

    /**
     * Set annullato
     *
     * @param string $annullato
     *
     * @return ZfcmsAlboAtti
     */
    public function setAnnullato($annullato)
    {
        $this->annullato = $annullato;
    
        return $this;
    }

    /**
     * Get annullato
     *
     * @return string
     */
    public function getAnnullato()
    {
        return $this->annullato;
    }

    /**
     * Set dataAnnullamento
     *
     * @param \DateTime $dataAnnullamento
     *
     * @return ZfcmsAlboAtti
     */
    public function setDataAnnullamento($dataAnnullamento)
    {
        $this->dataAnnullamento = $dataAnnullamento;
    
        return $this;
    }

    /**
     * Get dataAnnullamento
     *
     * @return \DateTime
     */
    public function getDataAnnullamento()
    {
        return $this->dataAnnullamento;
    }

    /**
     * Set noteAnnullamento
     *
     * @param string $noteAnnullamento
     *
     * @return ZfcmsAlboAtti
     */
    public function setNoteAnnullamento($noteAnnullamento)
    {
        $this->noteAnnullamento = $noteAnnullamento;
    
        return $this;
    }

    /**
     * Get noteAnnullamento
     *
     * @return string
     */
    public function getNoteAnnullamento()
    {
        return $this->noteAnnullamento;
    }

    /**
     * Set rettificato
     *
     * @param string $rettificato
     *
     * @return ZfcmsAlboAtti
     */
    public function setRettificato($rettificato)
    {
        $this->rettificato = $rettificato;
    
        return $this;
    }

    /**
     * Get rettificato
     *
     * @return string
     */
    public function getRettificato()
    {
        return $this->rettificato;
    }

    /**
     * Set dataRettifica
     *
     * @param \DateTime $dataRettifica
     *
     * @return ZfcmsAlboAtti
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
     * Set noteRettifica
     *
     * @param string $noteRettifica
     *
     * @return ZfcmsAlboAtti
     */
    public function setNoteRettifica($noteRettifica)
    {
        $this->noteRettifica = $noteRettifica;
    
        return $this;
    }

    /**
     * Get noteRettifica
     *
     * @return string
     */
    public function getNoteRettifica()
    {
        return $this->noteRettifica;
    }

    /**
     * Set stato
     *
     * @param string $stato
     *
     * @return ZfcmsAlboAtti
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return string
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set inviatoRegione
     *
     * @param string $inviatoRegione
     *
     * @return ZfcmsAlboAtti
     */
    public function setInviatoRegione($inviatoRegione)
    {
        $this->inviatoRegione = $inviatoRegione;
    
        return $this;
    }

    /**
     * Get inviatoRegione
     *
     * @return string
     */
    public function getInviatoRegione()
    {
        return $this->inviatoRegione;
    }

    /**
     * Set enteTerzo
     *
     * @param string $enteTerzo
     *
     * @return ZfcmsAlboAtti
     */
    public function setEnteTerzo($enteTerzo)
    {
        $this->enteTerzo = $enteTerzo;
    
        return $this;
    }

    /**
     * Get enteTerzo
     *
     * @return string
     */
    public function getEnteTerzo()
    {
        return $this->enteTerzo;
    }

    /**
     * Set seoTitle
     *
     * @param string $seoTitle
     *
     * @return ZfcmsAlboAtti
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
     * Set seoKeywords
     *
     * @param string $seoKeywords
     *
     * @return ZfcmsAlboAtti
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
     * Set seoDescription
     *
     * @param string $seoDescription
     *
     * @return ZfcmsAlboAtti
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
     * Set settore
     *
     * @param \Application\Entity\ZfcmsAlboSettori $settore
     *
     * @return ZfcmsAlboAtti
     */
    public function setSettore(\Application\Entity\ZfcmsAlboSettori $settore = null)
    {
        $this->settore = $settore;
    
        return $this;
    }

    /**
     * Get settore
     *
     * @return \Application\Entity\ZfcmsAlboSettori
     */
    public function getSettore()
    {
        return $this->settore;
    }

    /**
     * Set sezione
     *
     * @param \Application\Entity\ZfcmsAlboSettori $sezione
     *
     * @return ZfcmsAlboAtti
     */
    public function setSezione(\Application\Entity\ZfcmsAlboSettori $sezione = null)
    {
        $this->sezione = $sezione;
    
        return $this;
    }

    /**
     * Get sezione
     *
     * @return \Application\Entity\ZfcmsAlboSettori
     */
    public function getSezione()
    {
        return $this->sezione;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     *
     * @return ZfcmsAlboAtti
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
