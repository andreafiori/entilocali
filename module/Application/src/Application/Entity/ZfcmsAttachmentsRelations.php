<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachmentsRelations
 *
 * @ORM\Table(name="zfcms_attachments_relations", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="reference_id", columns={"reference_id"}), @ORM\Index(name="attachment_id", columns={"attachment_id"})})
 * @ORM\Entity
 */
class ZfcmsAttachmentsRelations
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
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="bigint", nullable=false)
     */
    private $referenceId;

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
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;



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
     * Set referenceId
     *
     * @param integer $referenceId
     * @return ZfcmsAttachmentsRelations
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
     * Set attachment
     *
     * @param \Application\Entity\ZfcmsAttachments $attachment
     * @return ZfcmsAttachmentsRelations
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
     * Set module
     *
     * @param \Application\Entity\ZfcmsModules $module
     * @return ZfcmsAttachmentsRelations
     */
    public function setModule(\Application\Entity\ZfcmsModules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\ZfcmsModules 
     */
    public function getModule()
    {
        return $this->module;
    }
}
