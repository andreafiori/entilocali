<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtentiPermessiNomi
 *
 * @ORM\Table(name="utenti_permessi_nomi")
 * @ORM\Entity
 */
class UtentiPermessiNomi
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
     * @ORM\Column(name="flag", type="string", length=50, nullable=true)
     */
    private $flag = '';

    /**
     * @var string
     *
     * @ORM\Column(name="descrizione", type="string", length=50, nullable=true)
     */
    private $descrizione = '';



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
     * Set flag
     *
     * @param string $flag
     *
     * @return UtentiPermessiNomi
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    
        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     *
     * @return UtentiPermessiNomi
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
}
