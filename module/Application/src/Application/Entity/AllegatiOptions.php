<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllegatiOptions
 *
 * @ORM\Table(name="allegati_options", indexes={@ORM\Index(name="allegato_id", columns={"allegato_id"})})
 * @ORM\Entity
 */
class AllegatiOptions
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
     * @ORM\Column(name="titolo", type="string", length=50, nullable=true)
     */
    private $titolo;

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=50, nullable=true)
     */
    private $descrizione;

    /**
     * @var \Application\Entity\Allegati
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Allegati")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allegato_id", referencedColumnName="id")
     * })
     */
    private $allegato;



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
     * Set titolo
     *
     * @param string $titolo
     *
     * @return AllegatiOptions
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
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return AllegatiOptions
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
     * Set allegato
     *
     * @param \Application\Entity\Allegati $allegato
     *
     * @return AllegatiOptions
     */
    public function setAllegato(\Application\Entity\Allegati $allegato = null)
    {
        $this->allegato = $allegato;
    
        return $this;
    }

    /**
     * Get allegato
     *
     * @return \Application\Entity\Allegati 
     */
    public function getAllegato()
    {
        return $this->allegato;
    }
}
