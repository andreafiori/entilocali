<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContratti
 *
 * @ORM\Table(name="zfcms_comuni_contratti", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="resp_proc_id", columns={"resp_proc_id"}), @ORM\Index(name="sezione_id", columns={"sezione_id"}), @ORM\Index(name="sc_contr_id", columns={"sc_contr_id"}), @ORM\Index(name="scadenza", columns={"scadenza"})})
 * @ORM\Entity
 */
class ZfcmsComuniContratti
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
     * @ORM\Column(name="beneficiario", type="text", length=65535, nullable=false)
     */
    private $beneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", length=65535, nullable=false)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="importo", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $importo = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="importo2", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $importo2 = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="operatori", type="text", length=65535, nullable=true)
     */
    private $operatori;

    /**
     * @var integer
     *
     * @ORM\Column(name="n_offerte", type="integer", nullable=true)
     */
    private $nOfferte = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="modassegn", type="text", length=65535, nullable=false)
     */
    private $modassegn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_agg", type="date", nullable=false)
     */
    private $dataAgg;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_contratto", type="date", nullable=false)
     */
    private $dataContratto;

    /**
     * @var integer
     *
     * @ORM\Column(name="progressivo", type="bigint", nullable=false)
     */
    private $progressivo;

    /**
     * @var string
     *
     * @ORM\Column(name="anno", type="text", length=65535, nullable=false)
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
     * @ORM\Column(name="sezione_id", type="bigint", nullable=false)
     */
    private $sezioneId;

    /**
     * @var integer
     *
     * @ORM\Column(name="resp_proc_id", type="bigint", nullable=false)
     */
    private $respProcId;

    /**
     * @var integer
     *
     * @ORM\Column(name="sc_contr_id", type="bigint", nullable=false)
     */
    private $scContrId;

    /**
     * @var string
     *
     * @ORM\Column(name="cig", type="text", length=65535, nullable=true)
     */
    private $cig;

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
     * Set beneficiario
     *
     * @param string $beneficiario
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     * Set importo2
     *
     * @param string $importo2
     *
     * @return ZfcmsComuniContratti
     */
    public function setImporto2($importo2)
    {
        $this->importo2 = $importo2;
    
        return $this;
    }

    /**
     * Get importo2
     *
     * @return string
     */
    public function getImporto2()
    {
        return $this->importo2;
    }

    /**
     * Set operatori
     *
     * @param string $operatori
     *
     * @return ZfcmsComuniContratti
     */
    public function setOperatori($operatori)
    {
        $this->operatori = $operatori;
    
        return $this;
    }

    /**
     * Get operatori
     *
     * @return string
     */
    public function getOperatori()
    {
        return $this->operatori;
    }

    /**
     * Set nOfferte
     *
     * @param integer $nOfferte
     *
     * @return ZfcmsComuniContratti
     */
    public function setNOfferte($nOfferte)
    {
        $this->nOfferte = $nOfferte;
    
        return $this;
    }

    /**
     * Get nOfferte
     *
     * @return integer
     */
    public function getNOfferte()
    {
        return $this->nOfferte;
    }

    /**
     * Set modassegn
     *
     * @param string $modassegn
     *
     * @return ZfcmsComuniContratti
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
     * Set dataAgg
     *
     * @param \DateTime $dataAgg
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataAgg($dataAgg)
    {
        $this->dataAgg = $dataAgg;
    
        return $this;
    }

    /**
     * Get dataAgg
     *
     * @return \DateTime
     */
    public function getDataAgg()
    {
        return $this->dataAgg;
    }

    /**
     * Set dataContratto
     *
     * @param \DateTime $dataContratto
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataContratto($dataContratto)
    {
        $this->dataContratto = $dataContratto;
    
        return $this;
    }

    /**
     * Get dataContratto
     *
     * @return \DateTime
     */
    public function getDataContratto()
    {
        return $this->dataContratto;
    }

    /**
     * Set progressivo
     *
     * @param integer $progressivo
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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
     * Set sezioneId
     *
     * @param integer $sezioneId
     *
     * @return ZfcmsComuniContratti
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
     *
     * @return ZfcmsComuniContratti
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

    /**
     * Set scContrId
     *
     * @param integer $scContrId
     *
     * @return ZfcmsComuniContratti
     */
    public function setScContrId($scContrId)
    {
        $this->scContrId = $scContrId;
    
        return $this;
    }

    /**
     * Get scContrId
     *
     * @return integer
     */
    public function getScContrId()
    {
        return $this->scContrId;
    }

    /**
     * Set cig
     *
     * @param string $cig
     *
     * @return ZfcmsComuniContratti
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
     * Set utente
     *
     * @param \Application\Entity\ZfcmsUsers $utente
     *
     * @return ZfcmsComuniContratti
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
