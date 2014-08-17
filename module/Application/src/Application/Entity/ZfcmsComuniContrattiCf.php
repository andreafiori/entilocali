<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsComuniContrattiCf
 *
 * @ORM\Table(name="zfcms_comuni_contratti_cf")
 * @ORM\Entity
 */
class ZfcmsComuniContrattiCf
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
     * @var string
     *
     * @ORM\Column(name="cf_struttura", type="text", nullable=false)
     */
    private $cfStruttura;



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
     * Set cfStruttura
     *
     * @param string $cfStruttura
     * @return ZfcmsComuniContrattiCf
     */
    public function setCfStruttura($cfStruttura)
    {
        $this->cfStruttura = $cfStruttura;
    
        return $this;
    }

    /**
     * Get cfStruttura
     *
     * @return string 
     */
    public function getCfStruttura()
    {
        return $this->cfStruttura;
    }
}
