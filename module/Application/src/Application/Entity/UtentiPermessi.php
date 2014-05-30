<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UtentiPermessi
 *
 * @ORM\Table(name="utenti_permessi", indexes={@ORM\Index(name="ruolo_id", columns={"ruolo_id"}), @ORM\Index(name="permesso_id", columns={"permesso_id"})})
 * @ORM\Entity
 */
class UtentiPermessi
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
     * @var string
     *
     * @ORM\Column(name="valore", type="string", length=50, nullable=false)
     */
    private $valore = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ruolo_id", type="bigint", nullable=false)
     */
    private $ruoloId;

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
     * Set valore
     *
     * @param string $valore
     *
     * @return UtentiPermessi
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
     * Set ruoloId
     *
     * @param integer $ruoloId
     *
     * @return UtentiPermessi
     */
    public function setRuoloId($ruoloId)
    {
        $this->ruoloId = $ruoloId;
    
        return $this;
    }

    /**
     * Get ruoloId
     *
     * @return integer
     */
    public function getRuoloId()
    {
        return $this->ruoloId;
    }

    /**
     * Set permessoId
     *
     * @param integer $permessoId
     *
     * @return UtentiPermessi
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
