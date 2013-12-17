<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoNazioni
 *
 * @ORM\Table(name="geo_nazioni", indexes={@ORM\Index(name="name", columns={"nomenazione"})})
 * @ORM\Entity
 */
class GeoNazioni
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
     * @ORM\Column(name="nomenazione", type="string", length=13, nullable=false)
     */
    private $nomenazione;

    /**
     * @var string
     *
     * @ORM\Column(name="flag", type="string", length=13, nullable=false)
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="iso", type="string", nullable=false)
     */
    private $iso;



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
     * Set nomenazione
     *
     * @param string $nomenazione
     * @return GeoNazioni
     */
    public function setNomenazione($nomenazione)
    {
        $this->nomenazione = $nomenazione;

        return $this;
    }

    /**
     * Get nomenazione
     *
     * @return string 
     */
    public function getNomenazione()
    {
        return $this->nomenazione;
    }

    /**
     * Set flag
     *
     * @param string $flag
     * @return GeoNazioni
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set iso
     *
     * @param string $iso
     * @return GeoNazioni
     */
    public function setIso($iso)
    {
        $this->iso = $iso;

        return $this;
    }

    /**
     * Get iso
     *
     * @return string 
     */
    public function getIso()
    {
        return $this->iso;
    }
}
