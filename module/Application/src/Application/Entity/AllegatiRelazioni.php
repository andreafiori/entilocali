<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllegatiRelazioni
 *
 * @ORM\Table(name="allegati_relazioni", indexes={@ORM\Index(name="module_id", columns={"modulo_id"}), @ORM\Index(name="allegato_id", columns={"allegato_id"}), @ORM\Index(name="riferimento_id", columns={"riferimento_id"})})
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
     * @ORM\Column(name="riferimento_id", type="bigint", nullable=false)
     */
    private $riferimentoId;

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
     * @var \Application\Entity\Moduli
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Moduli")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modulo_id", referencedColumnName="id")
     * })
     */
    private $modulo;



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
     * Set allegato
     *
     * @param \Application\Entity\Allegati $allegato
     *
     * @return AllegatiRelazioni
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

    /**
     * Set modulo
     *
     * @param \Application\Entity\Moduli $modulo
     *
     * @return AllegatiRelazioni
     */
    public function setModulo(\Application\Entity\Moduli $modulo = null)
    {
        $this->modulo = $modulo;
    
        return $this;
    }

    /**
     * Get modulo
     *
     * @return \Application\Entity\Moduli 
     */
    public function getModulo()
    {
        return $this->modulo;
    }
}
