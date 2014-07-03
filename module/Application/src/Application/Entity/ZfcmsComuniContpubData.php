<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContpubData
 *
 * @ORM\Table(name="zfcms_comuni_contpub_data")
 * @ORM\Entity
 */
class ZfcmsComuniContpubData
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="progressivo", type="integer", nullable=false)
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
     * @ORM\Column(name="id_utente", type="integer", nullable=false)
     */
    private $idUtente;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sezione", type="integer", nullable=false)
     */
    private $idSezione;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_resp_proc", type="integer", nullable=false)
     */
    private $idRespProc;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sc_contr", type="integer", nullable=false)
     */
    private $idScContr;

    /**
     * @var string
     *
     * @ORM\Column(name="cig", type="text", length=65535, nullable=true)
     */
    private $cig;



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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * Set idUtente
     *
     * @param integer $idUtente
     *
     * @return ZfcmsComuniContpubData
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
     * @return ZfcmsComuniContpubData
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
     * Set idRespProc
     *
     * @param integer $idRespProc
     *
     * @return ZfcmsComuniContpubData
     */
    public function setIdRespProc($idRespProc)
    {
        $this->idRespProc = $idRespProc;
    
        return $this;
    }

    /**
     * Get idRespProc
     *
     * @return integer
     */
    public function getIdRespProc()
    {
        return $this->idRespProc;
    }

    /**
     * Set idScContr
     *
     * @param integer $idScContr
     *
     * @return ZfcmsComuniContpubData
     */
    public function setIdScContr($idScContr)
    {
        $this->idScContr = $idScContr;
    
        return $this;
    }

    /**
     * Get idScContr
     *
     * @return integer
     */
    public function getIdScContr()
    {
        return $this->idScContr;
    }

    /**
     * Set cig
     *
     * @param string $cig
     *
     * @return ZfcmsComuniContpubData
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
}
