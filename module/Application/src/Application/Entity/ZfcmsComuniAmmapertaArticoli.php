<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniAmmapertaArticoli
 *
 * @ORM\Table(name="zfcms_comuni_ammaperta_articoli", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="sezione_id", columns={"sezione_id"}), @ORM\Index(name="resp_proc_id", columns={"resp_proc_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniAmmapertaArticoli
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
     * @ORM\Column(name="beneficiario", type="text", nullable=false)
     */
    private $beneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="importo", type="text", nullable=true)
     */
    private $importo;

    /**
     * @var string
     *
     * @ORM\Column(name="ufficioresponsabile", type="text", nullable=false)
     */
    private $ufficioresponsabile;

    /**
     * @var string
     *
     * @ORM\Column(name="modassegn", type="text", nullable=false)
     */
    private $modassegn;

    /**
     * @var integer
     *
     * @ORM\Column(name="progressivo", type="bigint", nullable=false)
     */
    private $progressivo;

    /**
     * @var string
     *
     * @ORM\Column(name="anno", type="text", nullable=false)
     */
    private $anno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data", type="date", nullable=false)
     */
    private $data;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora", type="time", nullable=false)
     */
    private $ora;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="scadenza", type="date", nullable=false)
     */
    private $scadenza;

    /**
     * @var integer
     *
     * @ORM\Column(name="utente_id", type="bigint", nullable=false)
     */
    private $utenteId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sezione_id", type="integer", nullable=false)
     */
    private $sezioneId;

    /**
     * @var integer
     *
     * @ORM\Column(name="resp_proc_id", type="bigint", nullable=true)
     */
    private $respProcId;



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
     * Set beneficiario
     *
     * @param string $beneficiario
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setBeneficiario($beneficiario)
    {
        $this->beneficiario = $beneficiario;
    
        return $this;
    }

    /**
     * Get beneficiario
     *
     * @return string 
     */
    public function getBeneficiario()
    {
        return $this->beneficiario;
    }

    /**
     * Set titolo
     *
     * @param string $titolo
     * @return ZfcmsComuniAmmapertaArticoli
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
     * Set importo
     *
     * @param string $importo
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setImporto($importo)
    {
        $this->importo = $importo;
    
        return $this;
    }

    /**
     * Get importo
     *
     * @return string 
     */
    public function getImporto()
    {
        return $this->importo;
    }

    /**
     * Set ufficioresponsabile
     *
     * @param string $ufficioresponsabile
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setUfficioresponsabile($ufficioresponsabile)
    {
        $this->ufficioresponsabile = $ufficioresponsabile;
    
        return $this;
    }

    /**
     * Get ufficioresponsabile
     *
     * @return string 
     */
    public function getUfficioresponsabile()
    {
        return $this->ufficioresponsabile;
    }

    /**
     * Set modassegn
     *
     * @param string $modassegn
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setModassegn($modassegn)
    {
        $this->modassegn = $modassegn;
    
        return $this;
    }

    /**
     * Get modassegn
     *
     * @return string 
     */
    public function getModassegn()
    {
        return $this->modassegn;
    }

    /**
     * Set progressivo
     *
     * @param integer $progressivo
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setProgressivo($progressivo)
    {
        $this->progressivo = $progressivo;
    
        return $this;
    }

    /**
     * Get progressivo
     *
     * @return integer 
     */
    public function getProgressivo()
    {
        return $this->progressivo;
    }

    /**
     * Set anno
     *
     * @param string $anno
     * @return ZfcmsComuniAmmapertaArticoli
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
     * Set data
     *
     * @param \DateTime $data
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return \DateTime 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set ora
     *
     * @param \DateTime $ora
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setOra($ora)
    {
        $this->ora = $ora;
    
        return $this;
    }

    /**
     * Get ora
     *
     * @return \DateTime 
     */
    public function getOra()
    {
        return $this->ora;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     * @return ZfcmsComuniAmmapertaArticoli
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
     * Set scadenza
     *
     * @param \DateTime $scadenza
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setScadenza($scadenza)
    {
        $this->scadenza = $scadenza;
    
        return $this;
    }

    /**
     * Get scadenza
     *
     * @return \DateTime 
     */
    public function getScadenza()
    {
        return $this->scadenza;
    }

    /**
     * Set utenteId
     *
     * @param integer $utenteId
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setUtenteId($utenteId)
    {
        $this->utenteId = $utenteId;
    
        return $this;
    }

    /**
     * Get utenteId
     *
     * @return integer 
     */
    public function getUtenteId()
    {
        return $this->utenteId;
    }

    /**
     * Set sezioneId
     *
     * @param integer $sezioneId
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setSezioneId($sezioneId)
    {
        $this->sezioneId = $sezioneId;
    
        return $this;
    }

    /**
     * Get sezioneId
     *
     * @return integer 
     */
    public function getSezioneId()
    {
        return $this->sezioneId;
    }

    /**
     * Set respProcId
     *
     * @param integer $respProcId
     * @return ZfcmsComuniAmmapertaArticoli
     */
    public function setRespProcId($respProcId)
    {
        $this->respProcId = $respProcId;
    
        return $this;
    }

    /**
     * Get respProcId
     *
     * @return integer 
     */
    public function getRespProcId()
    {
        return $this->respProcId;
    }
}
