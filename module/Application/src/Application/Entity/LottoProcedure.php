<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LottoProcedure
 *
 * @ORM\Table(name="lotto_procedure", uniqueConstraints={@ORM\UniqueConstraint(name="codiceasta", columns={"codiceasta"})}, indexes={@ORM\Index(name="ivg_id", columns={"ivg_id"}), @ORM\Index(name="tribunale_id", columns={"tribunale_id"}), @ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="entesattoriale_id", columns={"entesattoriale_id"})})
 * @ORM\Entity
 */
class LottoProcedure
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
     * @ORM\Column(name="codiceasta", type="string", length=15, nullable=false)
     */
    private $codiceasta;

    /**
     * @var integer
     *
     * @ORM\Column(name="numproc", type="bigint", nullable=false)
     */
    private $numproc = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="annoproc", type="bigint", nullable=false)
     */
    private $annoproc = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tipoasta", type="string", length=100, nullable=false)
     */
    private $tipoasta = 'con_incanto';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datasta", type="datetime", nullable=false)
     */
    private $datasta = '2007-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataordinanza", type="datetime", nullable=false)
     */
    private $dataordinanza = '2007-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datapublishweb", type="datetime", nullable=false)
     */
    private $datapublishweb = '2006-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="statoasta", type="string", length=100, nullable=false)
     */
    private $statoasta;

    /**
     * @var string
     *
     * @ORM\Column(name="creditore", type="string", length=100, nullable=false)
     */
    private $creditore = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="creditore_indir", type="string", length=100, nullable=false)
     */
    private $creditoreIndir;

    /**
     * @var string
     *
     * @ORM\Column(name="creditore_tel", type="string", length=100, nullable=false)
     */
    private $creditoreTel;

    /**
     * @var string
     *
     * @ORM\Column(name="creditore_disp", type="string", length=100, nullable=false)
     */
    private $creditoreDisp;

    /**
     * @var string
     *
     * @ORM\Column(name="custode_giudiziario", type="string", length=100, nullable=false)
     */
    private $custodeGiudiziario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="custod_indir", type="string", length=100, nullable=false)
     */
    private $custodIndir;

    /**
     * @var string
     *
     * @ORM\Column(name="custod_tel", type="string", length=100, nullable=false)
     */
    private $custodTel;

    /**
     * @var string
     *
     * @ORM\Column(name="custod_disp", type="string", length=100, nullable=false)
     */
    private $custodDisp;

    /**
     * @var string
     *
     * @ORM\Column(name="curatore", type="string", length=100, nullable=false)
     */
    private $curatore;

    /**
     * @var string
     *
     * @ORM\Column(name="giudice", type="string", length=100, nullable=false)
     */
    private $giudice = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="giudaddress", type="string", length=60, nullable=false)
     */
    private $giudaddress = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="giudnotaio_tel", type="string", length=60, nullable=false)
     */
    private $giudnotaioTel;

    /**
     * @var string
     *
     * @ORM\Column(name="giudnotaio_disp", type="string", length=60, nullable=false)
     */
    private $giudnotaioDisp;

    /**
     * @var string
     *
     * @ORM\Column(name="magistrato", type="string", length=100, nullable=false)
     */
    private $magistrato = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="soggettorichiedente", type="string", length=100, nullable=false)
     */
    private $soggettorichiedente;

    /**
     * @var string
     *
     * @ORM\Column(name="esecuzioneimmobiliare", type="string", length=100, nullable=false)
     */
    private $esecuzioneimmobiliare;

    /**
     * @var string
     *
     * @ORM\Column(name="delegato_vendita", type="string", length=100, nullable=false)
     */
    private $delegatoVendita;

    /**
     * @var string
     *
     * @ORM\Column(name="rito", type="text", nullable=false)
     */
    private $rito;

    /**
     * @var string
     *
     * @ORM\Column(name="notegeneriche", type="text", nullable=false)
     */
    private $notegeneriche;

    /**
     * @var string
     *
     * @ORM\Column(name="datilegale", type="string", length=100, nullable=false)
     */
    private $datilegale = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="datireferente", type="string", length=100, nullable=false)
     */
    private $datireferente = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishedwebdata", type="datetime", nullable=false)
     */
    private $publishedwebdata = '2013-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate = '2013-01-01 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="ivg_id", type="bigint", nullable=false)
     */
    private $ivgId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tribunale_id", type="bigint", nullable=false)
     */
    private $tribunaleId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="entesattoriale_id", type="bigint", nullable=false)
     */
    private $entesattorialeId = '0';



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
     * Set codiceasta
     *
     * @param string $codiceasta
     * @return LottoProcedure
     */
    public function setCodiceasta($codiceasta)
    {
        $this->codiceasta = $codiceasta;

        return $this;
    }

    /**
     * Get codiceasta
     *
     * @return string 
     */
    public function getCodiceasta()
    {
        return $this->codiceasta;
    }

    /**
     * Set numproc
     *
     * @param integer $numproc
     * @return LottoProcedure
     */
    public function setNumproc($numproc)
    {
        $this->numproc = $numproc;

        return $this;
    }

    /**
     * Get numproc
     *
     * @return integer 
     */
    public function getNumproc()
    {
        return $this->numproc;
    }

    /**
     * Set annoproc
     *
     * @param integer $annoproc
     * @return LottoProcedure
     */
    public function setAnnoproc($annoproc)
    {
        $this->annoproc = $annoproc;

        return $this;
    }

    /**
     * Get annoproc
     *
     * @return integer 
     */
    public function getAnnoproc()
    {
        return $this->annoproc;
    }

    /**
     * Set tipoasta
     *
     * @param string $tipoasta
     * @return LottoProcedure
     */
    public function setTipoasta($tipoasta)
    {
        $this->tipoasta = $tipoasta;

        return $this;
    }

    /**
     * Get tipoasta
     *
     * @return string 
     */
    public function getTipoasta()
    {
        return $this->tipoasta;
    }

    /**
     * Set datasta
     *
     * @param \DateTime $datasta
     * @return LottoProcedure
     */
    public function setDatasta($datasta)
    {
        $this->datasta = $datasta;

        return $this;
    }

    /**
     * Get datasta
     *
     * @return \DateTime 
     */
    public function getDatasta()
    {
        return $this->datasta;
    }

    /**
     * Set dataordinanza
     *
     * @param \DateTime $dataordinanza
     * @return LottoProcedure
     */
    public function setDataordinanza($dataordinanza)
    {
        $this->dataordinanza = $dataordinanza;

        return $this;
    }

    /**
     * Get dataordinanza
     *
     * @return \DateTime 
     */
    public function getDataordinanza()
    {
        return $this->dataordinanza;
    }

    /**
     * Set datapublishweb
     *
     * @param \DateTime $datapublishweb
     * @return LottoProcedure
     */
    public function setDatapublishweb($datapublishweb)
    {
        $this->datapublishweb = $datapublishweb;

        return $this;
    }

    /**
     * Get datapublishweb
     *
     * @return \DateTime 
     */
    public function getDatapublishweb()
    {
        return $this->datapublishweb;
    }

    /**
     * Set statoasta
     *
     * @param string $statoasta
     * @return LottoProcedure
     */
    public function setStatoasta($statoasta)
    {
        $this->statoasta = $statoasta;

        return $this;
    }

    /**
     * Get statoasta
     *
     * @return string 
     */
    public function getStatoasta()
    {
        return $this->statoasta;
    }

    /**
     * Set creditore
     *
     * @param string $creditore
     * @return LottoProcedure
     */
    public function setCreditore($creditore)
    {
        $this->creditore = $creditore;

        return $this;
    }

    /**
     * Get creditore
     *
     * @return string 
     */
    public function getCreditore()
    {
        return $this->creditore;
    }

    /**
     * Set creditoreIndir
     *
     * @param string $creditoreIndir
     * @return LottoProcedure
     */
    public function setCreditoreIndir($creditoreIndir)
    {
        $this->creditoreIndir = $creditoreIndir;

        return $this;
    }

    /**
     * Get creditoreIndir
     *
     * @return string 
     */
    public function getCreditoreIndir()
    {
        return $this->creditoreIndir;
    }

    /**
     * Set creditoreTel
     *
     * @param string $creditoreTel
     * @return LottoProcedure
     */
    public function setCreditoreTel($creditoreTel)
    {
        $this->creditoreTel = $creditoreTel;

        return $this;
    }

    /**
     * Get creditoreTel
     *
     * @return string 
     */
    public function getCreditoreTel()
    {
        return $this->creditoreTel;
    }

    /**
     * Set creditoreDisp
     *
     * @param string $creditoreDisp
     * @return LottoProcedure
     */
    public function setCreditoreDisp($creditoreDisp)
    {
        $this->creditoreDisp = $creditoreDisp;

        return $this;
    }

    /**
     * Get creditoreDisp
     *
     * @return string 
     */
    public function getCreditoreDisp()
    {
        return $this->creditoreDisp;
    }

    /**
     * Set custodeGiudiziario
     *
     * @param string $custodeGiudiziario
     * @return LottoProcedure
     */
    public function setCustodeGiudiziario($custodeGiudiziario)
    {
        $this->custodeGiudiziario = $custodeGiudiziario;

        return $this;
    }

    /**
     * Get custodeGiudiziario
     *
     * @return string 
     */
    public function getCustodeGiudiziario()
    {
        return $this->custodeGiudiziario;
    }

    /**
     * Set custodIndir
     *
     * @param string $custodIndir
     * @return LottoProcedure
     */
    public function setCustodIndir($custodIndir)
    {
        $this->custodIndir = $custodIndir;

        return $this;
    }

    /**
     * Get custodIndir
     *
     * @return string 
     */
    public function getCustodIndir()
    {
        return $this->custodIndir;
    }

    /**
     * Set custodTel
     *
     * @param string $custodTel
     * @return LottoProcedure
     */
    public function setCustodTel($custodTel)
    {
        $this->custodTel = $custodTel;

        return $this;
    }

    /**
     * Get custodTel
     *
     * @return string 
     */
    public function getCustodTel()
    {
        return $this->custodTel;
    }

    /**
     * Set custodDisp
     *
     * @param string $custodDisp
     * @return LottoProcedure
     */
    public function setCustodDisp($custodDisp)
    {
        $this->custodDisp = $custodDisp;

        return $this;
    }

    /**
     * Get custodDisp
     *
     * @return string 
     */
    public function getCustodDisp()
    {
        return $this->custodDisp;
    }

    /**
     * Set curatore
     *
     * @param string $curatore
     * @return LottoProcedure
     */
    public function setCuratore($curatore)
    {
        $this->curatore = $curatore;

        return $this;
    }

    /**
     * Get curatore
     *
     * @return string 
     */
    public function getCuratore()
    {
        return $this->curatore;
    }

    /**
     * Set giudice
     *
     * @param string $giudice
     * @return LottoProcedure
     */
    public function setGiudice($giudice)
    {
        $this->giudice = $giudice;

        return $this;
    }

    /**
     * Get giudice
     *
     * @return string 
     */
    public function getGiudice()
    {
        return $this->giudice;
    }

    /**
     * Set giudaddress
     *
     * @param string $giudaddress
     * @return LottoProcedure
     */
    public function setGiudaddress($giudaddress)
    {
        $this->giudaddress = $giudaddress;

        return $this;
    }

    /**
     * Get giudaddress
     *
     * @return string 
     */
    public function getGiudaddress()
    {
        return $this->giudaddress;
    }

    /**
     * Set giudnotaioTel
     *
     * @param string $giudnotaioTel
     * @return LottoProcedure
     */
    public function setGiudnotaioTel($giudnotaioTel)
    {
        $this->giudnotaioTel = $giudnotaioTel;

        return $this;
    }

    /**
     * Get giudnotaioTel
     *
     * @return string 
     */
    public function getGiudnotaioTel()
    {
        return $this->giudnotaioTel;
    }

    /**
     * Set giudnotaioDisp
     *
     * @param string $giudnotaioDisp
     * @return LottoProcedure
     */
    public function setGiudnotaioDisp($giudnotaioDisp)
    {
        $this->giudnotaioDisp = $giudnotaioDisp;

        return $this;
    }

    /**
     * Get giudnotaioDisp
     *
     * @return string 
     */
    public function getGiudnotaioDisp()
    {
        return $this->giudnotaioDisp;
    }

    /**
     * Set magistrato
     *
     * @param string $magistrato
     * @return LottoProcedure
     */
    public function setMagistrato($magistrato)
    {
        $this->magistrato = $magistrato;

        return $this;
    }

    /**
     * Get magistrato
     *
     * @return string 
     */
    public function getMagistrato()
    {
        return $this->magistrato;
    }

    /**
     * Set soggettorichiedente
     *
     * @param string $soggettorichiedente
     * @return LottoProcedure
     */
    public function setSoggettorichiedente($soggettorichiedente)
    {
        $this->soggettorichiedente = $soggettorichiedente;

        return $this;
    }

    /**
     * Get soggettorichiedente
     *
     * @return string 
     */
    public function getSoggettorichiedente()
    {
        return $this->soggettorichiedente;
    }

    /**
     * Set esecuzioneimmobiliare
     *
     * @param string $esecuzioneimmobiliare
     * @return LottoProcedure
     */
    public function setEsecuzioneimmobiliare($esecuzioneimmobiliare)
    {
        $this->esecuzioneimmobiliare = $esecuzioneimmobiliare;

        return $this;
    }

    /**
     * Get esecuzioneimmobiliare
     *
     * @return string 
     */
    public function getEsecuzioneimmobiliare()
    {
        return $this->esecuzioneimmobiliare;
    }

    /**
     * Set delegatoVendita
     *
     * @param string $delegatoVendita
     * @return LottoProcedure
     */
    public function setDelegatoVendita($delegatoVendita)
    {
        $this->delegatoVendita = $delegatoVendita;

        return $this;
    }

    /**
     * Get delegatoVendita
     *
     * @return string 
     */
    public function getDelegatoVendita()
    {
        return $this->delegatoVendita;
    }

    /**
     * Set rito
     *
     * @param string $rito
     * @return LottoProcedure
     */
    public function setRito($rito)
    {
        $this->rito = $rito;

        return $this;
    }

    /**
     * Get rito
     *
     * @return string 
     */
    public function getRito()
    {
        return $this->rito;
    }

    /**
     * Set notegeneriche
     *
     * @param string $notegeneriche
     * @return LottoProcedure
     */
    public function setNotegeneriche($notegeneriche)
    {
        $this->notegeneriche = $notegeneriche;

        return $this;
    }

    /**
     * Get notegeneriche
     *
     * @return string 
     */
    public function getNotegeneriche()
    {
        return $this->notegeneriche;
    }

    /**
     * Set datilegale
     *
     * @param string $datilegale
     * @return LottoProcedure
     */
    public function setDatilegale($datilegale)
    {
        $this->datilegale = $datilegale;

        return $this;
    }

    /**
     * Get datilegale
     *
     * @return string 
     */
    public function getDatilegale()
    {
        return $this->datilegale;
    }

    /**
     * Set datireferente
     *
     * @param string $datireferente
     * @return LottoProcedure
     */
    public function setDatireferente($datireferente)
    {
        $this->datireferente = $datireferente;

        return $this;
    }

    /**
     * Get datireferente
     *
     * @return string 
     */
    public function getDatireferente()
    {
        return $this->datireferente;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return LottoProcedure
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set publishedwebdata
     *
     * @param \DateTime $publishedwebdata
     * @return LottoProcedure
     */
    public function setPublishedwebdata($publishedwebdata)
    {
        $this->publishedwebdata = $publishedwebdata;

        return $this;
    }

    /**
     * Get publishedwebdata
     *
     * @return \DateTime 
     */
    public function getPublishedwebdata()
    {
        return $this->publishedwebdata;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     * @return LottoProcedure
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime 
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * Set ivgId
     *
     * @param integer $ivgId
     * @return LottoProcedure
     */
    public function setIvgId($ivgId)
    {
        $this->ivgId = $ivgId;

        return $this;
    }

    /**
     * Get ivgId
     *
     * @return integer 
     */
    public function getIvgId()
    {
        return $this->ivgId;
    }

    /**
     * Set tribunaleId
     *
     * @param integer $tribunaleId
     * @return LottoProcedure
     */
    public function setTribunaleId($tribunaleId)
    {
        $this->tribunaleId = $tribunaleId;

        return $this;
    }

    /**
     * Get tribunaleId
     *
     * @return integer 
     */
    public function getTribunaleId()
    {
        return $this->tribunaleId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return LottoProcedure
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set entesattorialeId
     *
     * @param integer $entesattorialeId
     * @return LottoProcedure
     */
    public function setEntesattorialeId($entesattorialeId)
    {
        $this->entesattorialeId = $entesattorialeId;

        return $this;
    }

    /**
     * Get entesattorialeId
     *
     * @return integer 
     */
    public function getEntesattorialeId()
    {
        return $this->entesattorialeId;
    }
}
