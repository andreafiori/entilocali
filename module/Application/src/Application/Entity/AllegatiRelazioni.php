<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllegatiRelazioni
 *
 * @ORM\Table(name="allegati_relazioni", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="allegato_id", columns={"allegato_id"}), @ORM\Index(name="riferimento_id", columns={"riferimento_id"})})
 * @ORM\Entity
 */
class AllegatiRelazioni
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
     * @var integer
     *
     * @ORM\Column(name="allegato_id", type="bigint", nullable=false)
     */
    private $allegatoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="riferimento_id", type="bigint", nullable=false)
     */
    private $riferimentoId;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=false)
     */
    private $moduleId;



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
     * Set allegatoId
     *
     * @param integer $allegatoId
     * @return AllegatiRelazioni
     */
    public function setAllegatoId($allegatoId)
    {
        $this->allegatoId = $allegatoId;

        return $this;
    }

    /**
     * Get allegatoId
     *
     * @return integer 
     */
    public function getAllegatoId()
    {
        return $this->allegatoId;
    }

    /**
     * Set riferimentoId
     *
     * @param integer $riferimentoId
     * @return AllegatiRelazioni
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
     * Set moduleId
     *
     * @param integer $moduleId
     * @return AllegatiRelazioni
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
