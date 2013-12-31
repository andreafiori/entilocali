<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuniCapQuartieri
 *
 * @ORM\Table(name="geo_comuni_cap_quartieri", indexes={@ORM\Index(name="quartiere_id", columns={"quartiere_id"}), @ORM\Index(name="cap_quartiere_id", columns={"cap_quartiere_id"})})
 * @ORM\Entity
 */
class GeoComuniCapQuartieri
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
     * @var \Application\Entity\GeoComuniCap
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\GeoComuniCap")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cap_quartiere_id", referencedColumnName="id")
     * })
     */
    private $capQuartiere;

    /**
     * @var \Application\Entity\GeoComuniQuartieri
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\GeoComuniQuartieri")
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
     * @param \Application\Entity\GeoComuniCap $capQuartiere
     * @return GeoComuniCapQuartieri
     */
    public function setCapQuartiere(\Application\Entity\GeoComuniCap $capQuartiere = null)
    {
        $this->capQuartiere = $capQuartiere;

        return $this;
    }

    /**
     * Get capQuartiere
     *
     * @return \Application\Entity\GeoComuniCap 
     */
    public function getCapQuartiere()
    {
        return $this->capQuartiere;
    }

    /**
     * Set quartiere
     *
     * @param \Application\Entity\GeoComuniQuartieri $quartiere
     * @return GeoComuniCapQuartieri
     */
    public function setQuartiere(\Application\Entity\GeoComuniQuartieri $quartiere = null)
    {
        $this->quartiere = $quartiere;

        return $this;
    }

    /**
     * Get quartiere
     *
     * @return \Application\Entity\GeoComuniQuartieri 
     */
    public function getQuartiere()
    {
        return $this->quartiere;
    }
}
