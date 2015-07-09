<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsGeoComuniCapQuartieri
 *
 * @ORM\Table(name="zfcms_geo_comuni_cap_quartieri", indexes={@ORM\Index(name="quartiere_id", columns={"quartiere_id"}), @ORM\Index(name="cap_quartiere_id", columns={"cap_quartiere_id"})})
 * @ORM\Entity
 */
class ZfcmsGeoComuniCapQuartieri
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
     * @var \Application\Entity\ZfcmsGeoComuniCap
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsGeoComuniCap")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cap_quartiere_id", referencedColumnName="id")
     * })
     */
    private $capQuartiere;

    /**
     * @var \Application\Entity\ZfcmsGeoComuniQuartieri
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsGeoComuniQuartieri")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="quartiere_id", referencedColumnName="id")
     * })
     */
    private $quartiere;



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
     * Set capQuartiere
     *
     * @param \Application\Entity\ZfcmsGeoComuniCap $capQuartiere
     *
     * @return ZfcmsGeoComuniCapQuartieri
     */
    public function setCapQuartiere(\Application\Entity\ZfcmsGeoComuniCap $capQuartiere = null)
    {
        $this->capQuartiere = $capQuartiere;
    
        return $this;
    }

    /**
     * Get capQuartiere
     *
     * @return \Application\Entity\ZfcmsGeoComuniCap
     */
    public function getCapQuartiere()
    {
        return $this->capQuartiere;
    }

    /**
     * Set quartiere
     *
     * @param \Application\Entity\ZfcmsGeoComuniQuartieri $quartiere
     *
     * @return ZfcmsGeoComuniCapQuartieri
     */
    public function setQuartiere(\Application\Entity\ZfcmsGeoComuniQuartieri $quartiere = null)
    {
        $this->quartiere = $quartiere;
    
        return $this;
    }

    /**
     * Get quartiere
     *
     * @return \Application\Entity\ZfcmsGeoComuniQuartieri
     */
    public function getQuartiere()
    {
        return $this->quartiere;
    }
}
