<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContratti
 *
 * @ORM\Table(name="zfcms_comuni_contratti", uniqueConstraints={@ORM\UniqueConstraint(name="cig", columns={"cig"})}, indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="resp_proc_id", columns={"resp_proc_id"}), @ORM\Index(name="sezione_id", columns={"settore_id"}), @ORM\Index(name="sc_contr_id", columns={"sc_contr_id"}), @ORM\Index(name="scadenza", columns={"scadenza"}), @ORM\Index(name="attivo", columns={"attivo"})})
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
     * @ORM\Column(name="beneficiario", type="text", length=65535, nullable=true)
     */
    private $beneficiario;

    /**
     * @var string
     *
     * @ORM\Column(name="titolo", type="text", length=65535, nullable=false)
     */
    private $titolo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_determina", type="bigint", nullable=true)
     */
    private $numeroDetermina = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_determina", type="date", nullable=false)
     */
    private $dataDetermina;

    /**
     * @var string
     *
     * @ORM\Column(name="importo_aggiudicazione", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $importoAggiudicazione = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="importo_liquidato", type="decimal", precision=12, scale=2, nullable=true)
     */
    private $importoLiquidato = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="operatori", type="text", length=65535, nullable=true)
     */
    private $operatori;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_offerte", type="integer", nullable=true)
     */
    private $numeroOfferte = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inizio_lavori", type="date", nullable=false)
     */
    private $dataInizioLavori;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_fine_lavori", type="date", nullable=false)
     */
    private $dataFineLavori;

    /**
     * @var integer
     *
     * @ORM\Column(name="progressivo", type="bigint", nullable=false)
     */
    private $progressivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="anno", type="integer", nullable=false)
     */
    private $anno;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_inserimento", type="date", nullable=false)
     */
    private $dataInserimento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ora_inserimento", type="time", nullable=false)
     */
    private $oraInserimento;

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
     * @ORM\Column(name="modalita_assegnazione", type="bigint", nullable=false)
     */
    private $modalitaAssegnazione;

    /**
     * @var string
     *
     * @ORM\Column(name="cig", type="string", length=20, nullable=true)
     */
    private $cig;

    /**
     * @var integer
     *
     * @ORM\Column(name="homepage", type="integer", nullable=false)
     */
    private $homepage;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_ultimo_aggiornamento", type="datetime", nullable=false)
     */
    private $dataUltimoAggiornamento;

    /**
     * @var \Application\Entity\ZfcmsUsersRespProc
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsersRespProc")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resp_proc_id", referencedColumnName="id")
     * })
     */
    private $respProc;

    /**
     * @var \Application\Entity\ZfcmsComuniContrattiScContr
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsComuniContrattiScContr")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sc_contr_id", referencedColumnName="id")
     * })
     */
    private $scContr;

    /**
     * @var \Application\Entity\ZfcmsUsersSettori
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsersSettori")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="settore_id", referencedColumnName="id")
     * })
     */
    private $settore;

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
     * Set numeroDetermina
     *
     * @param integer $numeroDetermina
     *
     * @return ZfcmsComuniContratti
     */
    public function setNumeroDetermina($numeroDetermina)
    {
        $this->numeroDetermina = $numeroDetermina;
    
        return $this;
    }

    /**
     * Get numeroDetermina
     *
     * @return integer
     */
    public function getNumeroDetermina()
    {
        return $this->numeroDetermina;
    }

    /**
     * Set dataDetermina
     *
     * @param \DateTime $dataDetermina
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataDetermina($dataDetermina)
    {
        $this->dataDetermina = $dataDetermina;
    
        return $this;
    }

    /**
     * Get dataDetermina
     *
     * @return \DateTime
     */
    public function getDataDetermina()
    {
        return $this->dataDetermina;
    }

    /**
     * Set importoAggiudicazione
     *
     * @param string $importoAggiudicazione
     *
     * @return ZfcmsComuniContratti
     */
    public function setImportoAggiudicazione($importoAggiudicazione)
    {
        $this->importoAggiudicazione = $importoAggiudicazione;
    
        return $this;
    }

    /**
     * Get importoAggiudicazione
     *
     * @return string
     */
    public function getImportoAggiudicazione()
    {
        return $this->importoAggiudicazione;
    }

    /**
     * Set importoLiquidato
     *
     * @param string $importoLiquidato
     *
     * @return ZfcmsComuniContratti
     */
    public function setImportoLiquidato($importoLiquidato)
    {
        $this->importoLiquidato = $importoLiquidato;
    
        return $this;
    }

    /**
     * Get importoLiquidato
     *
     * @return string
     */
    public function getImportoLiquidato()
    {
        return $this->importoLiquidato;
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
     * Set numeroOfferte
     *
     * @param integer $numeroOfferte
     *
     * @return ZfcmsComuniContratti
     */
    public function setNumeroOfferte($numeroOfferte)
    {
        $this->numeroOfferte = $numeroOfferte;
    
        return $this;
    }

    /**
     * Get numeroOfferte
     *
     * @return integer
     */
    public function getNumeroOfferte()
    {
        return $this->numeroOfferte;
    }

    /**
     * Set dataInizioLavori
     *
     * @param \DateTime $dataInizioLavori
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataInizioLavori($dataInizioLavori)
    {
        $this->dataInizioLavori = $dataInizioLavori;
    
        return $this;
    }

    /**
     * Get dataInizioLavori
     *
     * @return \DateTime
     */
    public function getDataInizioLavori()
    {
        return $this->dataInizioLavori;
    }

    /**
     * Set dataFineLavori
     *
     * @param \DateTime $dataFineLavori
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataFineLavori($dataFineLavori)
    {
        $this->dataFineLavori = $dataFineLavori;
    
        return $this;
    }

    /**
     * Get dataFineLavori
     *
     * @return \DateTime
     */
    public function getDataFineLavori()
    {
        return $this->dataFineLavori;
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
     * @param integer $anno
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
     * @return integer
     */
    public function getAnno()
    {
        return $this->anno;
    }

    /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     *
     * @return ZfcmsComuniContratti
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
     * Set oraInserimento
     *
     * @param \DateTime $oraInserimento
     *
     * @return ZfcmsComuniContratti
     */
    public function setOraInserimento($oraInserimento)
    {
        $this->oraInserimento = $oraInserimento;
    
        return $this;
    }

    /**
     * Get oraInserimento
     *
     * @return \DateTime
     */
    public function getOraInserimento()
    {
        return $this->oraInserimento;
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
     * Set modalitaAssegnazione
     *
     * @param integer $modalitaAssegnazione
     *
     * @return ZfcmsComuniContratti
     */
    public function setModalitaAssegnazione($modalitaAssegnazione)
    {
        $this->modalitaAssegnazione = $modalitaAssegnazione;
    
        return $this;
    }

    /**
     * Get modalitaAssegnazione
     *
     * @return integer
     */
    public function getModalitaAssegnazione()
    {
        return $this->modalitaAssegnazione;
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
     * Set homepage
     *
     * @param integer $homepage
     *
     * @return ZfcmsComuniContratti
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;
    
        return $this;
    }

    /**
     * Get homepage
     *
     * @return integer
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Set dataUltimoAggiornamento
     *
     * @param \DateTime $dataUltimoAggiornamento
     *
     * @return ZfcmsComuniContratti
     */
    public function setDataUltimoAggiornamento($dataUltimoAggiornamento)
    {
        $this->dataUltimoAggiornamento = $dataUltimoAggiornamento;
    
        return $this;
    }

    /**
     * Get dataUltimoAggiornamento
     *
     * @return \DateTime
     */
    public function getDataUltimoAggiornamento()
    {
        return $this->dataUltimoAggiornamento;
    }

    /**
     * Set respProc
     *
     * @param \Application\Entity\ZfcmsUsersRespProc $respProc
     *
     * @return ZfcmsComuniContratti
     */
    public function setRespProc(\Application\Entity\ZfcmsUsersRespProc $respProc = null)
    {
        $this->respProc = $respProc;
    
        return $this;
    }

    /**
     * Get respProc
     *
     * @return \Application\Entity\ZfcmsUsersRespProc
     */
    public function getRespProc()
    {
        return $this->respProc;
    }

    /**
     * Set scContr
     *
     * @param \Application\Entity\ZfcmsComuniContrattiScContr $scContr
     *
     * @return ZfcmsComuniContratti
     */
    public function setScContr(\Application\Entity\ZfcmsComuniContrattiScContr $scContr = null)
    {
        $this->scContr = $scContr;
    
        return $this;
    }

    /**
     * Get scContr
     *
     * @return \Application\Entity\ZfcmsComuniContrattiScContr
     */
    public function getScContr()
    {
        return $this->scContr;
    }

    /**
     * Set settore
     *
     * @param \Application\Entity\ZfcmsUsersSettori $settore
     *
     * @return ZfcmsComuniContratti
     */
    public function setSettore(\Application\Entity\ZfcmsUsersSettori $settore = null)
    {
        $this->settore = $settore;
    
        return $this;
    }

    /**
     * Get settore
     *
     * @return \Application\Entity\ZfcmsUsersSettori
     */
    public function getSettore()
    {
        return $this->settore;
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
