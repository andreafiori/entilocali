<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LingueEtichette
 *
 * @ORM\Table(name="lingue_etichette", indexes={@ORM\Index(name="language", columns={"lingua_id"}), @ORM\Index(name="module_id", columns={"modulo_id"}), @ORM\Index(name="isadmin", columns={"isbackend"}), @ORM\Index(name="isuniversal", columns={"isuniversal"})})
 * @ORM\Entity
 */
class LingueEtichette
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
     * @ORM\Column(name="nome", type="string", length=80, nullable=true)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="valore", type="text", nullable=true)
     */
    private $valore;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="text", nullable=true)
     */
    private $descrizione;

    /**
     * @var integer
     *
     * @ORM\Column(name="isbackend", type="bigint", nullable=true)
     */
    private $isbackend = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="isuniversal", type="bigint", nullable=true)
     */
    private $isuniversal = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_id", type="bigint", nullable=true)
     */
    private $moduloId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="lingua_id", type="bigint", nullable=true)
     */
    private $linguaId = '1';



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
     * @return LingueEtichette
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
     * Set valore
     *
     * @param string $valore
     *
     * @return LingueEtichette
     */
    public function setValore($valore)
    {
        $this->valore = $valore;
    
        return $this;
    }

    /**
     * Get valore
     *
     * @return string 
     */
    public function getValore()
    {
        return $this->valore;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return LingueEtichette
     */
    public function setDescrizione($descrizione)
    {
        $this->descrizione = $descrizione;
    
        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string 
     */
    public function getDescrizione()
    {
        return $this->descrizione;
    }

    /**
     * Set isbackend
     *
     * @param integer $isbackend
     *
     * @return LingueEtichette
     */
    public function setIsbackend($isbackend)
    {
        $this->isbackend = $isbackend;
    
        return $this;
    }

    /**
     * Get isbackend
     *
     * @return integer 
     */
    public function getIsbackend()
    {
        return $this->isbackend;
    }

    /**
     * Set isuniversal
     *
     * @param integer $isuniversal
     *
     * @return LingueEtichette
     */
    public function setIsuniversal($isuniversal)
    {
        $this->isuniversal = $isuniversal;
    
        return $this;
    }

    /**
     * Get isuniversal
     *
     * @return integer 
     */
    public function getIsuniversal()
    {
        return $this->isuniversal;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return LingueEtichette
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
     * Set moduloId
     *
     * @param integer $moduloId
     *
     * @return LingueEtichette
     */
    public function setModuloId($moduloId)
    {
        $this->moduloId = $moduloId;
    
        return $this;
    }

    /**
     * Get moduloId
     *
     * @return integer 
     */
    public function getModuloId()
    {
        return $this->moduloId;
    }

    /**
     * Set linguaId
     *
     * @param integer $linguaId
     *
     * @return LingueEtichette
     */
    public function setLinguaId($linguaId)
    {
        $this->linguaId = $linguaId;
    
        return $this;
    }

    /**
     * Get linguaId
     *
     * @return integer 
     */
    public function getLinguaId()
    {
        return $this->linguaId;
    }
}
