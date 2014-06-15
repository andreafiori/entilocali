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
     * @var integer
     *
     * @ORM\Column(name="attachment_id", type="bigint", nullable=true)
     */
    private $attachmentId;



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
     *
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
     *
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
     * Set attachmentId
     *
     * @param integer $attachmentId
     *
     * @return ZfcmsAttachmentsOptions
     */
    public function setAttachmentId($attachmentId)
    {
        $this->attachmentId = $attachmentId;
    
        return $this;
    }

    /**
     * Get attachmentId
     *
     * @return integer
     */
    public function getAttachmentId()
    {
        return $this->attachmentId;
    }
}
