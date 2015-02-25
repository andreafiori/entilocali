<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsHomepage
 *
 * @ORM\Table(name="zfcms_homepage", indexes={@ORM\Index(name="reference_id", columns={"reference_id"}), @ORM\Index(name="block_id", columns={"block_id"})})
 * @ORM\Entity
 */
class ZfcmsHomepage
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
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="free_text", type="text", length=65535, nullable=true)
     */
    private $freeText;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="integer", nullable=true)
     */
    private $referenceId;

    /**
     * @var \Application\Entity\ZfcmsHomepageBlocks
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsHomepageBlocks")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="block_id", referencedColumnName="id")
     * })
     */
    private $block;



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
     * Set position
     *
     * @param integer $position
     * @return ZfcmsHomepage
     */
    public function setPosition($position)
    {
        $this->position = $position;
    
        return $this;
    }

    /**
     * Get position
     *
     * @return integer 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set freeText
     *
     * @param string $freeText
     * @return ZfcmsHomepage
     */
    public function setFreeText($freeText)
    {
        $this->freeText = $freeText;
    
        return $this;
    }

    /**
     * Get freeText
     *
     * @return string 
     */
    public function getFreeText()
    {
        return $this->freeText;
    }

    /**
     * Set referenceId
     *
     * @param integer $referenceId
     * @return ZfcmsHomepage
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
     * Set block
     *
     * @param \Application\Entity\ZfcmsHomepageBlocks $block
     * @return ZfcmsHomepage
     */
    public function setBlock(\Application\Entity\ZfcmsHomepageBlocks $block = null)
    {
        $this->block = $block;
    
        return $this;
    }

    /**
     * Get block
     *
     * @return \Application\Entity\ZfcmsHomepageBlocks 
     */
    public function getBlock()
    {
        return $this->block;
    }
}
