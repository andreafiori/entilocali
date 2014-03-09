<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttachmentOptions
 *
 * @ORM\Table(name="attachment_options", indexes={@ORM\Index(name="attachment_id", columns={"attachment_id"})})
 * @ORM\Entity
 */
class AttachmentOptions
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
     * @ORM\Column(name="filetitle", type="string", length=50, nullable=true)
     */
    private $filetitle;

    /**
     * @var string
     *
     * @ORM\Column(name="filedescription", type="string", length=50, nullable=true)
     */
    private $filedescription;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set filetitle
     *
     * @param string $filetitle
     * @return AttachmentOptions
     */
    public function setFiletitle($filetitle)
    {
        $this->filetitle = $filetitle;

        return $this;
    }

    /**
     * Get filetitle
     *
     * @return string 
     */
    public function getFiletitle()
    {
        return $this->filetitle;
    }

    /**
     * Set filedescription
     *
     * @param string $filedescription
     * @return AttachmentOptions
     */
    public function setFiledescription($filedescription)
    {
        $this->filedescription = $filedescription;

        return $this;
    }

    /**
     * Get filedescription
     *
     * @return string 
     */
    public function getFiledescription()
    {
        return $this->filedescription;
    }

    /**
     * Set attachment
     *
     * @param \Application\Entity\Attachments $attachment
     * @return AttachmentOptions
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
}
