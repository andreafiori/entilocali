<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AlboSettori
 *
 * @ORM\Table(name="albo_settori", indexes={@ORM\Index(name="albosettorisearch", columns={"provincia_id"})})
 * @ORM\Entity
 */
class AlboSettori
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
     * @ORM\Column(name="settore", type="string", length=100, nullable=false)
     */
    private $settore;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="posizione", type="integer", nullable=false)
     */
    private $posizione;

    /**
     * @var \Application\Entity\GeoProvince
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\GeoProvince")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia_id", referencedColumnName="id")
     * })
     */
    private $provincia;



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
     * Set settore
     *
     * @param string $settore
     * @return AlboSettori
     */
    public function setSettore($settore)
    {
        $this->settore = $settore;

        return $this;
    }

    /**
     * Get settore
     *
     * @return string 
     */
    public function getSettore()
    {
        return $this->settore;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return AlboSettori
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set posizione
     *
     * @param integer $posizione
     * @return AlboSettori
     */
    public function setPosizione($posizione)
    {
        $this->posizione = $posizione;

        return $this;
    }

    /**
     * Get posizione
     *
     * @return integer 
     */
    public function getPosizione()
    {
        return $this->posizione;
    }

    /**
     * Set provincia
     *
     * @param \Application\Entity\GeoProvince $provincia
     * @return AlboSettori
     */
    public function setProvincia(\Application\Entity\GeoProvince $provincia = null)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Application\Entity\GeoProvince 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
