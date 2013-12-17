<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeoComuniCapQuartieri
 *
 * @ORM\Table(name="geo_comuni_cap_quartieri")
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
     * @var integer
     *
     * @ORM\Column(name="cap_quartiere_id", type="integer", nullable=false)
     */
    private $capQuartiereId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="quartiere_id", type="integer", nullable=false)
     */
    private $quartiereId = '0';



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
     * Set capQuartiereId
     *
     * @param integer $capQuartiereId
     * @return GeoComuniCapQuartieri
     */
    public function setCapQuartiereId($capQuartiereId)
    {
        $this->capQuartiereId = $capQuartiereId;

        return $this;
    }

    /**
     * Get capQuartiereId
     *
     * @return integer 
     */
    public function getCapQuartiereId()
    {
        return $this->capQuartiereId;
    }

    /**
     * Set quartiereId
     *
     * @param integer $quartiereId
     * @return GeoComuniCapQuartieri
     */
    public function setQuartiereId($quartiereId)
    {
        $this->quartiereId = $quartiereId;

        return $this;
    }

    /**
     * Get quartiereId
     *
     * @return integer 
     */
    public function getQuartiereId()
    {
        return $this->quartiereId;
    }
}
