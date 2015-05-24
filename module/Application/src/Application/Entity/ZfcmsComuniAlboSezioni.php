<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniAlboSezioni
 *
 * @ORM\Table(name="zfcms_comuni_albo_sezioni")
 * @ORM\Entity
 */
class ZfcmsComuniAlboSezioni
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
     * @ORM\Column(name="nome", type="text", length=65535, nullable=false)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="attivo", type="integer", nullable=false)
     */
    private $attivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="dest", type="integer", nullable=true)
     */
    private $dest = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="del", type="integer", nullable=true)
     */
    private $del = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="det", type="integer", nullable=true)
     */
    private $det = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="esi", type="integer", nullable=true)
     */
    private $esi = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ban", type="integer", nullable=true)
     */
    private $ban = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="con", type="integer", nullable=true)
     */
    private $con = '0';



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
     * Set nome
     *
     * @param string $nome
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set attivo
     *
     * @param integer $attivo
     *
     * @return ZfcmsComuniAlboSezioni
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
     * Set dest
     *
     * @param integer $dest
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setDest($dest)
    {
        $this->dest = $dest;
    
        return $this;
    }

    /**
     * Get dest
     *
     * @return integer
     */
    public function getDest()
    {
        return $this->dest;
    }

    /**
     * Set del
     *
     * @param integer $del
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setDel($del)
    {
        $this->del = $del;
    
        return $this;
    }

    /**
     * Get del
     *
     * @return integer
     */
    public function getDel()
    {
        return $this->del;
    }

    /**
     * Set det
     *
     * @param integer $det
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setDet($det)
    {
        $this->det = $det;
    
        return $this;
    }

    /**
     * Get det
     *
     * @return integer
     */
    public function getDet()
    {
        return $this->det;
    }

    /**
     * Set esi
     *
     * @param integer $esi
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setEsi($esi)
    {
        $this->esi = $esi;
    
        return $this;
    }

    /**
     * Get esi
     *
     * @return integer
     */
    public function getEsi()
    {
        return $this->esi;
    }

    /**
     * Set ban
     *
     * @param integer $ban
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setBan($ban)
    {
        $this->ban = $ban;
    
        return $this;
    }

    /**
     * Get ban
     *
     * @return integer
     */
    public function getBan()
    {
        return $this->ban;
    }

    /**
     * Set con
     *
     * @param integer $con
     *
     * @return ZfcmsComuniAlboSezioni
     */
    public function setCon($con)
    {
        $this->con = $con;
    
        return $this;
    }

    /**
     * Get con
     *
     * @return integer
     */
    public function getCon()
    {
        return $this->con;
    }
}
