<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniAlboArticoli
 *
 * @ORM\Table(name="zfcms_comuni_albo_articoli", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="sezione_id", columns={"sezione_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniAlboArticoli
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
     * @ORM\Column(name="cig", type="string", length=20, nullable=false)
     */
    private $cig;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_progressivo", type="bigint", nullable=false)
     */
    private $numeroProgressivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_atto", type="bigint", nullable=false)
     */
    private $numeroAtto;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=false)
     */
    private $anno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_attivazione", type="datetime", nullable=false)
     */
    private $dataAttivazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora_attivazione", type="time", nullable=false)
     */
    private $oraAttivazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_pubblicare", type="datetime", nullable=false)
     */
    private $dataPubblicare;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora_pubblicare", type="time", nullable=false)
     */
    private $oraPubblicare;

    /**
     * @var integer
     *
     * @ORM\Column(name="scadenza", type="integer", nullable=false)
     */
    private $scadenza;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="datetime", nullable=false)
     */
    private $dataScadenza;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", length=65535, nullable=false)
     */
    private $titolo;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="pubblicare", type="integer", nullable=false)
     */
    private $pubblicare;

    /**
     * @var integer
     *
     * @ORM\Column(name="annullato", type="integer", nullable=false)
     */
    private $annullato;

    /**
     * @var integer
     *
     * @ORM\Column(name="rettifica_id", type="integer", nullable=false)
     */
    private $rettificaId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_invio_regione", type="datetime", nullable=false)
     */
    private $dataInvioRegione;

    /**
     * @var integer
     *
     * @ORM\Column(name="num_att", type="integer", nullable=false)
     */
    private $numAtt;

    /**
     * @var integer
     *
     * @ORM\Column(name="check_invia_regione", type="integer", nullable=false)
     */
    private $checkInviaRegione;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno_atto", type="integer", nullable=false)
     */
    private $annoAtto;

    /**
     * @var integer
     *
     * @ORM\Column(name="home", type="integer", nullable=false)
     */
    private $home;

    /**
     * @var string
     *
     * @ORM\Column(name="ente_terzo", type="text", length=65535, nullable=false)
     */
    private $enteTerzo;

    /**
     * @var string
     *
     * @ORM\Column(name="fonte_url", type="text", length=65535, nullable=true)
     */
    private $fonteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", length=65535, nullable=false)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_rettifica", type="datetime", nullable=false)
     */
    private $dataRettifica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_annullamento", type="datetime", nullable=false)
     */
    private $dataAnnullamento;

    /**
     * @var integer
     *
     * @ORM\Column(name="check_rettifica", type="integer", nullable=false)
     */
    private $checkRettifica;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag_allegati", type="integer", nullable=false)
     */
    private $flagAllegati;

    /**
     * @var string
     *
     * @ORM\Column(name="spesa_prevista", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $spesaPrevista;

    /**
     * @var \Application\Entity\ZfcmsComuniAlboSezioni
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniAlboSezioni")
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
     * Set cig
     *
     * @param string $cig
     * @return ZfcmsComuniAlboArticoli
     */
    public function setCig($cig)
    {
        $this->cig = $cig;
    
        return $this;
    }

    /**
     * Get cig
     *
     * @return string 
     */
    public function getCig()
    {
        return $this->cig;
    }

    /**
     * Set numeroProgressivo
     *
     * @param integer $numeroProgressivo
     * @return ZfcmsComuniAlboArticoli
     */
    public function setNumeroProgressivo($numeroProgressivo)
    {
        $this->numeroProgressivo = $numeroProgressivo;
    
        return $this;
    }

    /**
     * Get numeroProgressivo
     *
     * @return integer 
     */
    public function getNumeroProgressivo()
    {
        return $this->numeroProgressivo;
    }

    /**
     * Set numeroAtto
     *
     * @param integer $numeroAtto
     * @return ZfcmsComuniAlboArticoli
     */
    public function setNumeroAtto($numeroAtto)
    {
        $this->numeroAtto = $numeroAtto;
    
        return $this;
    }

    /**
     * Get numeroAtto
     *
     * @return integer 
     */
    public function getNumeroAtto()
    {
        return $this->numeroAtto;
    }

    /**
     * Set anno
     *
     * @param integer $anno
     * @return ZfcmsComuniAlboArticoli
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
     * Set dataAttivazione
     *
     * @param \DateTime $dataAttivazione
     * @return ZfcmsComuniAlboArticoli
     */
    public function setDataAttivazione($dataAttivazione)
    {
        $this->dataAttivazione = $dataAttivazione;
    
        return $this;
    }

    /**
     * Get dataAttivazione
     *
     * @return \DateTime 
     */
    public function getDataAttivazione()
    {
        return $this->dataAttivazione;
    }

    /**
     * Set oraAttivazione
     *
     * @param \DateTime $oraAttivazione
     * @return ZfcmsComuniAlboArticoli
     */
    public function setOraAttivazione($oraAttivazione)
    {
        $this->oraAttivazione = $oraAttivazione;
    
        return $this;
    }

    /**
     * Get oraAttivazione
     *
     * @return \DateTime 
     */
    public function getOraAttivazione()
    {
        return $this->oraAttivazione;
    }

    /**
     * Set dataPubblicare
     *
     * @param \DateTime $dataPubblicare
     * @return ZfcmsComuniAlboArticoli
     */
    public function setDataPubblicare($dataPubblicare)
    {
        $this->dataPubblicare = $dataPubblicare;
    
        return $this;
    }

    /**
     * Get dataPubblicare
     *
     * @return \DateTime 
     */
    public function getDataPubblicare()
    {
        return $this->dataPubblicare;
    }

    /**
     * Set oraPubblicare
     *
     * @param \DateTime $oraPubblicare
     * @return ZfcmsComuniAlboArticoli
     */
    public function setOraPubblicare($oraPubblicare)
    {
        $this->oraPubblicare = $oraPubblicare;
    
        return $this;
    }

    /**
     * Get oraPubblicare
     *
     * @return \DateTime 
     */
    public function getOraPubblicare()
    {
        return $this->oraPubblicare;
    }

    /**
     * Set scadenza
     *
     * @param integer $scadenza
     * @return ZfcmsComuniAlboArticoli
     */
    public function setScadenza($scadenza)
    {
        $this->scadenza = $scadenza;
    
        return $this;
    }

    /**
     * Get scadenza
     *
     * @return integer 
     */
    public function getScadenza()
    {
        return $this->scadenza;
    }

    /**
     * Set dataScadenza
     *
     * @param \DateTime $dataScadenza
     * @return ZfcmsComuniAlboArticoli
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
     * Set titolo
     *
     * @param string $titolo
     * @return ZfcmsComuniAlboArticoli
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
     * Set attivo
     *
     * @param integer $attivo
     * @return ZfcmsComuniAlboArticoli
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
     * Set pubblicare
     *
     * @param integer $pubblicare
     * @return ZfcmsComuniAlboArticoli
     */
    public function setPubblicare($pubblicare)
    {
        $this->pubblicare = $pubblicare;
    
        return $this;
    }

    /**
     * Get pubblicare
     *
     * @return integer 
     */
    public function getPubblicare()
    {
        return $this->pubblicare;
    }

    /**
     * Set annullato
     *
     * @param integer $annullato
     * @return ZfcmsComuniAlboArticoli
     */
    public function setAnnullato($annullato)
    {
        $this->annullato = $annullato;
    
        return $this;
    }

    /**
     * Get annullato
     *
     * @return integer 
     */
    public function getAnnullato()
    {
        return $this->annullato;
    }

    /**
     * Set rettificaId
     *
     * @param integer $rettificaId
     * @return ZfcmsComuniAlboArticoli
     */
    public function setRettificaId($rettificaId)
    {
        $this->rettificaId = $rettificaId;
    
        return $this;
    }

    /**
     * Get rettificaId
     *
     * @return integer 
     */
    public function getRettificaId()
    {
        return $this->rettificaId;
    }

    /**
     * Set dataInvioRegione
     *
     * @param \DateTime $dataInvioRegione
     * @return ZfcmsComuniAlboArticoli
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
     * Set numAtt
     *
     * @param integer $numAtt
     * @return ZfcmsComuniAlboArticoli
     */
    public function setNumAtt($numAtt)
    {
        $this->numAtt = $numAtt;
    
        return $this;
    }

    /**
     * Get numAtt
     *
     * @return integer 
     */
    public function getNumAtt()
    {
        return $this->numAtt;
    }

    /**
     * Set checkInviaRegione
     *
     * @param integer $checkInviaRegione
     * @return ZfcmsComuniAlboArticoli
     */
    public function setCheckInviaRegione($checkInviaRegione)
    {
        $this->checkInviaRegione = $checkInviaRegione;
    
        return $this;
    }

    /**
     * Get checkInviaRegione
     *
     * @return integer 
     */
    public function getCheckInviaRegione()
    {
        return $this->checkInviaRegione;
    }

    /**
     * Set annoAtto
     *
     * @param integer $annoAtto
     * @return ZfcmsComuniAlboArticoli
     */
    public function setAnnoAtto($annoAtto)
    {
        $this->annoAtto = $annoAtto;
    
        return $this;
    }

    /**
     * Get annoAtto
     *
     * @return integer 
     */
    public function getAnnoAtto()
    {
        return $this->annoAtto;
    }

    /**
     * Set home
     *
     * @param integer $home
     * @return ZfcmsComuniAlboArticoli
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
     * Set enteTerzo
     *
     * @param string $enteTerzo
     * @return ZfcmsComuniAlboArticoli
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
     * Set fonteUrl
     *
     * @param string $fonteUrl
     * @return ZfcmsComuniAlboArticoli
     */
    public function setFonteUrl($fonteUrl)
    {
        $this->fonteUrl = $fonteUrl;
    
        return $this;
    }

    /**
     * Get fonteUrl
     *
     * @return string 
     */
    public function getFonteUrl()
    {
        return $this->fonteUrl;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return ZfcmsComuniAlboArticoli
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set dataRettifica
     *
     * @param \DateTime $dataRettifica
     * @return ZfcmsComuniAlboArticoli
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
     * Set dataAnnullamento
     *
     * @param \DateTime $dataAnnullamento
     * @return ZfcmsComuniAlboArticoli
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
     * Set checkRettifica
     *
     * @param integer $checkRettifica
     * @return ZfcmsComuniAlboArticoli
     */
    public function setCheckRettifica($checkRettifica)
    {
        $this->checkRettifica = $checkRettifica;
    
        return $this;
    }

    /**
     * Get checkRettifica
     *
     * @return integer 
     */
    public function getCheckRettifica()
    {
        return $this->checkRettifica;
    }

    /**
     * Set flagAllegati
     *
     * @param integer $flagAllegati
     * @return ZfcmsComuniAlboArticoli
     */
    public function setFlagAllegati($flagAllegati)
    {
        $this->flagAllegati = $flagAllegati;
    
        return $this;
    }

    /**
     * Get flagAllegati
     *
     * @return integer 
     */
    public function getFlagAllegati()
    {
        return $this->flagAllegati;
    }

    /**
     * Set spesaPrevista
     *
     * @param string $spesaPrevista
     * @return ZfcmsComuniAlboArticoli
     */
    public function setSpesaPrevista($spesaPrevista)
    {
        $this->spesaPrevista = $spesaPrevista;
    
        return $this;
    }

    /**
     * Get spesaPrevista
     *
     * @return string 
     */
    public function getSpesaPrevista()
    {
        return $this->spesaPrevista;
    }

    /**
     * Set sezione
     *
     * @param \Application\Entity\ZfcmsComuniAlboSezioni $sezione
     * @return ZfcmsComuniAlboArticoli
     */
    public function setSezione(\Application\Entity\ZfcmsComuniAlboSezioni $sezione = null)
    {
        $this->sezione = $sezione;
    
        return $this;
    }

    /**
     * Get sezione
     *
     * @return \Application\Entity\ZfcmsComuniAlboSezioni 
     */
    public function getSezione()
    {
        return $this->sezione;
    }

    /**
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     * @return ZfcmsComuniAlboArticoli
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
