<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachmentsOptions
 *
 * @ORM\Table(name="zfcms_attachments_options", indexes={@ORM\Index(name="attachment_id", columns={"attachment_id"}), @ORM\Index(name="fk_attachments_options_lang", columns={"language_id"})})
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
     * @ORM\Column(name="title", type="text", length=65535, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=true)
     */
    private $expireDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=true)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="atti_column_category", type="integer", nullable=true)
     */
    private $attiColumnCategory;

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
     * @var \Application\Entity\ZfcmsLanguages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsLanguages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;



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
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return ZfcmsAttachmentsOptions
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    
        return $this;
    }

    /**
     * Get expireDate
     *
     * @return \DateTime 
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ZfcmsAttachmentsOptions
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
     * Set status
     *
     * @param string $status
     * @return ZfcmsAttachmentsOptions
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
     * Set attiColumnCategory
     *
     * @param integer $attiColumnCategory
     * @return ZfcmsAttachmentsOptions
     */
    public function setAttiColumnCategory($attiColumnCategory)
    {
        $this->attiColumnCategory = $attiColumnCategory;
    
        return $this;
    }

    /**
     * Get attiColumnCategory
     *
     * @return integer 
     */
    public function getAttiColumnCategory()
    {
        return $this->attiColumnCategory;
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

    /**
     * Set language
     *
     * @param \Application\Entity\ZfcmsLanguages $language
     * @return ZfcmsAttachmentsOptions
     */
    public function setLanguage(\Application\Entity\ZfcmsLanguages $language = null)
    {
        $this->language = $language;
    
        return $this;
    }

    /**
     * Get language
     *
     * @return \Application\Entity\ZfcmsLanguages 
     */
    public function getLanguage()
    {
        return $this->language;
    }
}
