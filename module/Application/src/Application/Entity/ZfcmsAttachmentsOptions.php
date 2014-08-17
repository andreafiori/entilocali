<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachmentsOptions
 *
 * @ORM\Table(name="zfcms_attachments_options", indexes={@ORM\Index(name="attachment_id", columns={"attachment_id"})})
 * @ORM\Entity
 */
class ZfcmsAttachmentsOptions
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
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=50, nullable=true)
     */
    private $description;

    /**
     * @var \Application\Entity\ZfcmsAttachments
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsAttachments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attachment_id", referencedColumnName="id")
     * })
     */
    private $attachment;



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
     * @return ZfcmsAttachmentsOptions
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
     * @return ZfcmsAttachmentsOptions
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
     * Set attachment
     *
     * @param \Application\Entity\ZfcmsAttachments $attachment
     * @return ZfcmsAttachmentsOptions
     */
    public function setAttachment(\Application\Entity\ZfcmsAttachments $attachment = null)
    {
        $this->attachment = $attachment;
    
        return $this;
    }

    /**
     * Get attachment
     *
     * @return \Application\Entity\ZfcmsAttachments 
     */
    public function getAttachment()
    {
        return $this->attachment;
    }
}
