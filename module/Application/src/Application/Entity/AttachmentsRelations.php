<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttachmentsRelations
 *
 * @ORM\Table(name="attachments_relations", indexes={@ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="reference_id", columns={"reference_id"}), @ORM\Index(name="attachment_id", columns={"attachment_id"})})
 * @ORM\Entity
 */
class AttachmentsRelations
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
     * @var \Application\Entity\Attachments
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Attachments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attachment_id", referencedColumnName="id")
     * })
     */
    private $attachment;

    /**
     * @var \Application\Entity\Modules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Modules")
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
     *
     * @return AttachmentsRelations
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
     * @param \Application\Entity\Attachments $attachment
     *
     * @return AttachmentsRelations
     */
    public function setAttachment(\Application\Entity\Attachments $attachment = null)
    {
        $this->attachment = $attachment;
    
        return $this;
    }

    /**
     * Get attachment
     *
     * @return \Application\Entity\Attachments
     */
    public function getAttachment()
    {
        return $this->attachment;
    }

    /**
     * Set module
     *
     * @param \Application\Entity\Modules $module
     *
     * @return AttachmentsRelations
     */
    public function setModule(\Application\Entity\Modules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\Modules
     */
    public function getModule()
    {
        return $this->module;
    }
}
