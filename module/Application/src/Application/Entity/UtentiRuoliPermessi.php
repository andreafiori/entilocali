<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtentiRuoliPermessi
 *
 * @ORM\Table(name="utenti_ruoli_permessi", indexes={@ORM\Index(name="ruolo_permesso_id", columns={"ruolo_permesso_id"}), @ORM\Index(name="permesso_id", columns={"permesso_id"})})
 * @ORM\Entity
 */
class UtentiRuoliPermessi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruolo_permesso_id", type="bigint", nullable=false)
     */
    private $ruoloPermessoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="permesso_id", type="bigint", nullable=false)
     */
    private $permessoId;



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
     * Set ruoloPermessoId
     *
     * @param integer $ruoloPermessoId
     *
     * @return UtentiRuoliPermessi
     */
    public function setRuoloPermessoId($ruoloPermessoId)
    {
        $this->ruoloPermessoId = $ruoloPermessoId;
    
        return $this;
    }

    /**
     * Get ruoloPermessoId
     *
     * @return integer 
     */
    public function getRuoloPermessoId()
    {
        return $this->ruoloPermessoId;
    }

    /**
     * Set permessoId
     *
     * @param integer $permessoId
     *
     * @return UtentiRuoliPermessi
     */
    public function setPermessoId($permessoId)
    {
        $this->permessoId = $permessoId;
    
        return $this;
    }

    /**
     * Get permessoId
     *
     * @return integer 
     */
    public function getPermessoId()
    {
        return $this->permessoId;
    }
}
