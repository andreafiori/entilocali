<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniModuli
 *
 * @ORM\Table(name="zfcms_comuni_moduli")
 * @ORM\Entity
 */
class ZfcmsComuniModuli
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
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=100, nullable=false)
     */
    private $accesskey;

    /**
     * @var integer
     *
     * @ORM\Column(name="front", type="integer", nullable=false)
     */
    private $front = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ordine", type="integer", nullable=false)
     */
    private $ordine;



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
     * @return ZfcmsComuniModuli
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
     * @return ZfcmsComuniModuli
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
     * Set accesskey
     *
     * @param string $accesskey
     *
     * @return ZfcmsComuniModuli
     */
    public function setAccesskey($accesskey)
    {
        $this->accesskey = $accesskey;
    
        return $this;
    }

    /**
     * Get accesskey
     *
     * @return string
     */
    public function getAccesskey()
    {
        return $this->accesskey;
    }

    /**
     * Set front
     *
     * @param integer $front
     *
     * @return ZfcmsComuniModuli
     */
    public function setFront($front)
    {
        $this->front = $front;
    
        return $this;
    }

    /**
     * Get front
     *
     * @return integer
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set ordine
     *
     * @param integer $ordine
     *
     * @return ZfcmsComuniModuli
     */
    public function setOrdine($ordine)
    {
        $this->ordine = $ordine;
    
        return $this;
    }

    /**
     * Get ordine
     *
     * @return integer
     */
    public function getOrdine()
    {
        return $this->ordine;
    }
}
