<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniAlboArticoli
 *
 * @ORM\Table(name="zfcms_comuni_albo_articoli")
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
     * @var integer
     *
     * @ORM\Column(name="id_utente", type="bigint", nullable=false)
     */
    private $idUtente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sezione", type="bigint", nullable=false)
     */
    private $idSezione;

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
     * @var string
     *
     * @ORM\Column(name="anno", type="text", length=65535, nullable=false)
     */
    private $anno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_attivazione", type="date", nullable=false)
     */
    private $dataAttivazione = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora_attivazione", type="time", nullable=false)
     */
    private $oraAttivazione;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_pubblicare", type="date", nullable=false)
     */
    private $dataPubblicare = '0000-00-00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora_pubblicare", type="time", nullable=false)
     */
    private $oraPubblicare = '00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="scadenza", type="integer", nullable=false)
     */
    private $scadenza;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_scadenza", type="date", nullable=false)
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
    private $annullato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="id_rettifica", type="integer", nullable=false)
     */
    private $idRettifica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_invio_regione", type="date", nullable=false)
     */
    private $dataInvioRegione = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="num_att", type="integer", nullable=false)
     */
    private $numAtt = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="check_invia_regione", type="integer", nullable=false)
     */
    private $checkInviaRegione = '0';

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
     * @ORM\Column(name="data_rettifica", type="date", nullable=false)
     */
    private $dataRettifica = '0000-00-00';

    /**
     * @var integer
     *
     * @ORM\Column(name="check_rettifica", type="integer", nullable=false)
     */
    private $checkRettifica;



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
     * Set idUtente
     *
     * @param integer $idUtente
     *
     * @return ZfcmsComuniAlboArticoli
     */
    public function setIdUtente($idUtente)
    {
        $this->idUtente = $idUtente;
    
        return $this;
    }

    /**
     * Get idUtente
     *
     * @return integer
     */
    public function getIdUtente()
    {
        return $this->idUtente;
    }

    /**
     * Set idSezione
     *
     * @param integer $idSezione
     *
     * @return ZfcmsComuniAlboArticoli
     */
    public function setIdSezione($idSezione)
    {
        $this->idSezione = $idSezione;
    
        return $this;
    }

    /**
     * Get idSezione
     *
     * @return integer
     */
    public function getIdSezione()
    {
        return $this->idSezione;
    }

    /**
     * Set numeroProgressivo
     *
     * @param integer $numeroProgressivo
     *
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
     *
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
     * @param string $anno
     *
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
     * @return string
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set dataAttivazione
     *
     * @param \DateTime $dataAttivazione
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     * Set idRettifica
     *
     * @param integer $idRettifica
     *
     * @return ZfcmsComuniAlboArticoli
     */
    public function setIdRettifica($idRettifica)
    {
        $this->idRettifica = $idRettifica;
    
        return $this;
    }

    /**
     * Get idRettifica
     *
     * @return integer
     */
    public function getIdRettifica()
    {
        return $this->idRettifica;
    }

    /**
     * Set dataInvioRegione
     *
     * @param \DateTime $dataInvioRegione
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
     * Set checkRettifica
     *
     * @param integer $checkRettifica
     *
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
}
