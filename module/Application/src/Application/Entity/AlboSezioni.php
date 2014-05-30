<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlboSezioni
 *
 * @ORM\Table(name="albo_sezioni", indexes={@ORM\Index(name="subsezione_id", columns={"subsezione_id"})})
 * @ORM\Entity
 */
class AlboSezioni
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
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=false)
     */
    private $position;

    /**
     * @var integer
     *
     * @ORM\Column(name="subsezione_id", type="bigint", nullable=false)
     */
    private $subsezioneId;



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
     * @return AlboSezioni
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
     * Set status
     *
     * @param string $status
     *
     * @return AlboSezioni
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
     * Set position
     *
     * @param integer $position
     *
     * @return AlboSezioni
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set subsezioneId
     *
     * @param integer $subsezioneId
     *
     * @return AlboSezioni
     */
    public function setSubsezioneId($subsezioneId)
    {
        $this->subsezioneId = $subsezioneId;
    
        return $this;
    }

    /**
     * Get subsezioneId
     *
     * @return integer
     */
    public function getSubsezioneId()
    {
        return $this->subsezioneId;
    }
}
