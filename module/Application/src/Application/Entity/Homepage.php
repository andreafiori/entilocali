<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage
 *
 * @ORM\Table(name="homepage", indexes={@ORM\Index(name="modulo_id", columns={"modulo_id"})})
 * @ORM\Entity
 */
class Homepage
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
     * @var integer
     *
     * @ORM\Column(name="riferimento_id", type="integer", nullable=true)
     */
    private $riferimentoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_id", type="integer", nullable=false)
     */
    private $moduloId = '0';



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
     * Set riferimentoId
     *
     * @param integer $riferimentoId
     *
     * @return Homepage
     */
    public function setRiferimentoId($riferimentoId)
    {
        $this->riferimentoId = $riferimentoId;
    
        return $this;
    }

    /**
     * Get riferimentoId
     *
     * @return integer
     */
    public function getRiferimentoId()
    {
        return $this->riferimentoId;
    }

    /**
     * Set moduloId
     *
     * @param integer $moduloId
     *
     * @return Homepage
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
}
