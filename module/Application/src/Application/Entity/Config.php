<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config", indexes={@ORM\Index(name="channel_id", columns={"canale_id"}), @ORM\Index(name="language_id", columns={"lingua_id"}), @ORM\Index(name="module_id", columns={"modulo_id"}), @ORM\Index(name="isadmin", columns={"isbackend"}), @ORM\Index(name="isalwaysallowed", columns={"isalwaysallowed"})})
 * @ORM\Entity
 */
class Config
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=true)
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
     * @ORM\Column(name="note", type="string", length=100, nullable=true)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="isbackend", type="bigint", nullable=false)
     */
    private $isbackend;

    /**
     * @var integer
     *
     * @ORM\Column(name="isalwaysallowed", type="bigint", nullable=false)
     */
    private $isalwaysallowed = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_id", type="bigint", nullable=false)
     */
    private $moduloId = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="canale_id", type="bigint", nullable=false)
     */
    private $canaleId = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="lingua_id", type="bigint", nullable=false)
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
     * @return Config
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
     * @return Config
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
     * Set note
     *
     * @param string $note
     * @return Config
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set isbackend
     *
     * @param integer $isbackend
     * @return Config
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
     * Set isalwaysallowed
     *
     * @param integer $isalwaysallowed
     * @return Config
     */
    public function setIsalwaysallowed($isalwaysallowed)
    {
        $this->isalwaysallowed = $isalwaysallowed;

        return $this;
    }

    /**
     * Get isalwaysallowed
     *
     * @return integer 
     */
    public function getIsalwaysallowed()
    {
        return $this->isalwaysallowed;
    }

    /**
     * Set moduloId
     *
     * @param integer $moduloId
     * @return Config
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
     * Set canaleId
     *
     * @param integer $canaleId
     * @return Config
     */
    public function setCanaleId($canaleId)
    {
        $this->canaleId = $canaleId;

        return $this;
    }

    /**
     * Get canaleId
     *
     * @return integer 
     */
    public function getCanaleId()
    {
        return $this->canaleId;
    }

    /**
     * Set linguaId
     *
     * @param integer $linguaId
     * @return Config
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
