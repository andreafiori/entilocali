<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Homepage
 *
 * @ORM\Table(name="homepage", indexes={@ORM\Index(name="modulo_id", columns={"module_id"})})
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
     * @ORM\Column(name="reference_id", type="integer", nullable=true)
     */
    private $referenceId;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     */
    private $moduleId = '0';



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
     * Set referenceId
     *
     * @param integer $referenceId
     *
     * @return Homepage
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    
        return $this;
    }

    /**
     * Get referenceId
     *
     * @return integer
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
     * @return Homepage
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;
    
        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }
}
