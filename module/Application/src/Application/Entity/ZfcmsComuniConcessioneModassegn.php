<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniConcessioneModassegn
 *
 * @ORM\Table(name="zfcms_comuni_concessione_modassegn")
 * @ORM\Entity
 */
class ZfcmsComuniConcessioneModassegn
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
     * @ORM\Column(name="nome", type="text", length=65535, nullable=true)
     */
    private $nome;

    /**
     * @var integer
     *
     * @ORM\Column(name="stato", type="integer", nullable=true)
     */
    private $stato;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=true)
     */
    private $posizione;



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
     * @return ZfcmsComuniConcessioneModassegn
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
     * Set stato
     *
     * @param integer $stato
     * @return ZfcmsComuniConcessioneModassegn
     */
    public function setStato($stato)
    {
        $this->stato = $stato;
    
        return $this;
    }

    /**
     * Get stato
     *
     * @return integer 
     */
    public function getStato()
    {
        return $this->stato;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return ZfcmsComuniConcessioneModassegn
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;
    
        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer 
     */
    public function getPosizione()
    {
        return $this->posizione;
    }
}
