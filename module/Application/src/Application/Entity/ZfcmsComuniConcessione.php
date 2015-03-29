<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniConcessione
 *
 * @ORM\Table(name="zfcms_comuni_concessione", indexes={@ORM\Index(name="utente_id", columns={"utente_id"}), @ORM\Index(name="sezione_id", columns={"settore_id"}), @ORM\Index(name="resp_proc_id", columns={"resp_proc_id"})})
 * @ORM\Entity
 */
class ZfcmsComuniConcessione
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
     * @ORM\Column(name="key_imp", type="string", length=80, nullable=false)
     */
    private $keyImp;

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
     * @ORM\Column(name="importo", type="text", length=65535, nullable=true)
     */
    private $importo;

    /**
     * @var string
     *
     * @ORM\Column(name="ufficioresponsabile", type="text", length=65535, nullable=false)
     */
    private $ufficioresponsabile;

    /**
     * @var string
     *
     * @ORM\Column(name="modassegn", type="text", length=65535, nullable=false)
     */
    private $modassegn;

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
     * @ORM\Column(name="flag_allegati", type="integer", nullable=false)
     */
    private $flagAllegati;

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
     * Set keyImp
     *
     * @param string $keyImp
     * @return ZfcmsComuniConcessione
     */
    public function setKeyImp($keyImp)
    {
        $this->keyImp = $keyImp;
    
        return $this;
    }

    /**
     * Get keyImp
     *
     * @return string 
     */
    public function getKeyImp()
    {
        return $this->keyImp;
    }

    /**
     * Set beneficiario
     *
     * @param string $beneficiario
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * Set data
     *
     * @param \DateTime $data
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
     * Set flagAllegati
     *
     * @param integer $flagAllegati
     * @return ZfcmsComuniConcessione
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
     * Set respProc
     *
     * @param \Application\Entity\ZfcmsUsersRespProc $respProc
     * @return ZfcmsComuniConcessione
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
     * Set settore
     *
     * @param \Application\Entity\ZfcmsUsersSettori $settore
     * @return ZfcmsComuniConcessione
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
     * @return ZfcmsComuniConcessione
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
