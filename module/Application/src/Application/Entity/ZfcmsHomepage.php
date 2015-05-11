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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="free_text", type="text", length=65535, nullable=true)
     */
    private $freeText;

    /**
     * @var integer
     *
     * @ORM\Column(name="show_attachments", type="integer", nullable=false)
     */
    private $showAttachments;

    /**
     * @var integer
     *
     * @ORM\Column(name="highlight", type="integer", nullable=false)
     */
    private $highlight;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=true)
     */
    private $position;

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
     * Set title
     *
     * @param string $title
     * @return ZfcmsHomepage
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ZfcmsHomepage
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set showAttachments
     *
     * @param integer $showAttachments
     * @return ZfcmsHomepage
     */
    public function setShowAttachments($showAttachments)
    {
        $this->showAttachments = $showAttachments;
    
        return $this;
    }

    /**
     * Get showAttachments
     *
     * @return integer 
     */
    public function getShowAttachments()
    {
        return $this->showAttachments;
    }

    /**
     * Set highlight
     *
     * @param integer $highlight
     * @return ZfcmsHomepage
     */
    public function setHighlight($highlight)
    {
        $this->highlight = $highlight;
    
        return $this;
    }

    /**
     * Get highlight
     *
     * @return integer 
     */
    public function getHighlight()
    {
        return $this->highlight;
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
