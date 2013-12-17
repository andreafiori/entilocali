<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lotto
 *
 * @ORM\Table(name="lotto", indexes={@ORM\Index(name="srchfileds", columns={"regione_id", "provincia_id", "comune_id", "procedura_id", "tipobene_id"})})
 * @ORM\Entity
 */
class Lotto
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
     * @ORM\Column(name="numlotto", type="string", length=100, nullable=false)
     */
    private $numlotto;

    /**
     * @var string
     *
     * @ORM\Column(name="nomebene", type="string", length=100, nullable=false)
     */
    private $nomebene;

    /**
     * @var string
     *
     * @ORM\Column(name="ctu", type="string", length=100, nullable=false)
     */
    private $ctu;

    /**
     * @var string
     *
     * @ORM\Column(name="statocc", type="string", length=50, nullable=false)
     */
    private $statocc;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizionelt", type="text", nullable=false)
     */
    private $descrizionelt;

    /**
     * @var string
     *
     * @ORM\Column(name="regimetrib", type="string", length=100, nullable=false)
     */
    private $regimetrib;

    /**
     * @var string
     *
     * @ORM\Column(name="valoreperizia", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $valoreperizia;

    /**
     * @var string
     *
     * @ORM\Column(name="indirizzo", type="string", length=100, nullable=false)
     */
    private $indirizzo;

    /**
     * @var string
     *
     * @ORM\Column(name="mq", type="decimal", precision=60, scale=0, nullable=false)
     */
    private $mq = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="vani", type="integer", nullable=false)
     */
    private $vani = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="piano", type="string", length=11, nullable=false)
     */
    private $piano;

    /**
     * @var string
     *
     * @ORM\Column(name="daticatastali", type="text", nullable=false)
     */
    private $daticatastali;

    /**
     * @var string
     *
     * @ORM\Column(name="disponibilita", type="text", nullable=false)
     */
    private $disponibilita;

    /**
     * @var integer
     *
     * @ORM\Column(name="regione_id", type="integer", nullable=false)
     */
    private $regioneId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="provincia_id", type="integer", nullable=false)
     */
    private $provinciaId;

    /**
     * @var integer
     *
     * @ORM\Column(name="comune_id", type="integer", nullable=false)
     */
    private $comuneId;

    /**
     * @var integer
     *
     * @ORM\Column(name="procedura_id", type="integer", nullable=false)
     */
    private $proceduraId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipobene_id", type="integer", nullable=false)
     */
    private $tipobeneId = '0';



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
     * Set numlotto
     *
     * @param string $numlotto
     * @return Lotto
     */
    public function setNumlotto($numlotto)
    {
        $this->numlotto = $numlotto;

        return $this;
    }

    /**
     * Get numlotto
     *
     * @return string 
     */
    public function getNumlotto()
    {
        return $this->numlotto;
    }

    /**
     * Set nomebene
     *
     * @param string $nomebene
     * @return Lotto
     */
    public function setNomebene($nomebene)
    {
        $this->nomebene = $nomebene;

        return $this;
    }

    /**
     * Get nomebene
     *
     * @return string 
     */
    public function getNomebene()
    {
        return $this->nomebene;
    }

    /**
     * Set ctu
     *
     * @param string $ctu
     * @return Lotto
     */
    public function setCtu($ctu)
    {
        $this->ctu = $ctu;

        return $this;
    }

    /**
     * Get ctu
     *
     * @return string 
     */
    public function getCtu()
    {
        return $this->ctu;
    }

    /**
     * Set statocc
     *
     * @param string $statocc
     * @return Lotto
     */
    public function setStatocc($statocc)
    {
        $this->statocc = $statocc;

        return $this;
    }

    /**
     * Get statocc
     *
     * @return string 
     */
    public function getStatocc()
    {
        return $this->statocc;
    }

    /**
     * Set descrizionelt
     *
     * @param string $descrizionelt
     * @return Lotto
     */
    public function setDescrizionelt($descrizionelt)
    {
        $this->descrizionelt = $descrizionelt;

        return $this;
    }

    /**
     * Get descrizionelt
     *
     * @return string 
     */
    public function getDescrizionelt()
    {
        return $this->descrizionelt;
    }

    /**
     * Set regimetrib
     *
     * @param string $regimetrib
     * @return Lotto
     */
    public function setRegimetrib($regimetrib)
    {
        $this->regimetrib = $regimetrib;

        return $this;
    }

    /**
     * Get regimetrib
     *
     * @return string 
     */
    public function getRegimetrib()
    {
        return $this->regimetrib;
    }

    /**
     * Set valoreperizia
     *
     * @param string $valoreperizia
     * @return Lotto
     */
    public function setValoreperizia($valoreperizia)
    {
        $this->valoreperizia = $valoreperizia;

        return $this;
    }

    /**
     * Get valoreperizia
     *
     * @return string 
     */
    public function getValoreperizia()
    {
        return $this->valoreperizia;
    }

    /**
     * Set indirizzo
     *
     * @param string $indirizzo
     * @return Lotto
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set mq
     *
     * @param string $mq
     * @return Lotto
     */
    public function setMq($mq)
    {
        $this->mq = $mq;

        return $this;
    }

    /**
     * Get mq
     *
     * @return string 
     */
    public function getMq()
    {
        return $this->mq;
    }

    /**
     * Set vani
     *
     * @param integer $vani
     * @return Lotto
     */
    public function setVani($vani)
    {
        $this->vani = $vani;

        return $this;
    }

    /**
     * Get vani
     *
     * @return integer 
     */
    public function getVani()
    {
        return $this->vani;
    }

    /**
     * Set piano
     *
     * @param string $piano
     * @return Lotto
     */
    public function setPiano($piano)
    {
        $this->piano = $piano;

        return $this;
    }

    /**
     * Get piano
     *
     * @return string 
     */
    public function getPiano()
    {
        return $this->piano;
    }

    /**
     * Set daticatastali
     *
     * @param string $daticatastali
     * @return Lotto
     */
    public function setDaticatastali($daticatastali)
    {
        $this->daticatastali = $daticatastali;

        return $this;
    }

    /**
     * Get daticatastali
     *
     * @return string 
     */
    public function getDaticatastali()
    {
        return $this->daticatastali;
    }

    /**
     * Set disponibilita
     *
     * @param string $disponibilita
     * @return Lotto
     */
    public function setDisponibilita($disponibilita)
    {
        $this->disponibilita = $disponibilita;

        return $this;
    }

    /**
     * Get disponibilita
     *
     * @return string 
     */
    public function getDisponibilita()
    {
        return $this->disponibilita;
    }

    /**
     * Set regioneId
     *
     * @param integer $regioneId
     * @return Lotto
     */
    public function setRegioneId($regioneId)
    {
        $this->regioneId = $regioneId;

        return $this;
    }

    /**
     * Get regioneId
     *
     * @return integer 
     */
    public function getRegioneId()
    {
        return $this->regioneId;
    }

    /**
     * Set provinciaId
     *
     * @param integer $provinciaId
     * @return Lotto
     */
    public function setProvinciaId($provinciaId)
    {
        $this->provinciaId = $provinciaId;

        return $this;
    }

    /**
     * Get provinciaId
     *
     * @return integer 
     */
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    /**
     * Set comuneId
     *
     * @param integer $comuneId
     * @return Lotto
     */
    public function setComuneId($comuneId)
    {
        $this->comuneId = $comuneId;

        return $this;
    }

    /**
     * Get comuneId
     *
     * @return integer 
     */
    public function getComuneId()
    {
        return $this->comuneId;
    }

    /**
     * Set proceduraId
     *
     * @param integer $proceduraId
     * @return Lotto
     */
    public function setProceduraId($proceduraId)
    {
        $this->proceduraId = $proceduraId;

        return $this;
    }

    /**
     * Get proceduraId
     *
     * @return integer 
     */
    public function getProceduraId()
    {
        return $this->proceduraId;
    }

    /**
     * Set tipobeneId
     *
     * @param integer $tipobeneId
     * @return Lotto
     */
    public function setTipobeneId($tipobeneId)
    {
        $this->tipobeneId = $tipobeneId;

        return $this;
    }

    /**
     * Get tipobeneId
     *
     * @return integer 
     */
    public function getTipobeneId()
    {
        return $this->tipobeneId;
    }
}
