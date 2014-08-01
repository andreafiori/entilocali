<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsAttachments
 *
 * @ORM\Table(name="zfcms_attachments", indexes={@ORM\Index(name="mime_id", columns={"mime_id"})})
 * @ORM\Entity
 */
class ZfcmsAttachments
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
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string", length=60, nullable=false)
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=true)
     */
    private $expireDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="mime_id", type="integer", nullable=false)
     */
    private $mimeId;



    /**
     * Get id.
    
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
    
     *
     * @param string $name
     *
     * @return ZfcmsAttachments
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name.
    
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set size.
    
     *
     * @param string $size
     *
     * @return ZfcmsAttachments
     */
    public function setSize($size)
    {
        $this->size = $size;
    
        return $this;
    }

    /**
     * Get size.
    
     *
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set state.
    
     *
     * @param string $state
     *
     * @return ZfcmsAttachments
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state.
    
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set insertDate.
    
     *
     * @param \DateTime $insertDate
     *
     * @return ZfcmsAttachments
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate.
    
     *
     * @return \DateTime
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set expireDate.
    
     *
     * @param \DateTime $expireDate
     *
     * @return ZfcmsAttachments
     */
    public function setExpireDate($expireDate)
    {
        $this->expireDate = $expireDate;
    
        return $this;
    }

    /**
     * Get expireDate.
    
     *
     * @return \DateTime
     */
    public function getExpireDate()
    {
        return $this->expireDate;
    }

    /**
     * Set mimeId.
    
     *
     * @param integer $mimeId
     *
     * @return ZfcmsAttachments
     */
    public function setMimeId($mimeId)
    {
        $this->mimeId = $mimeId;
    
        return $this;
    }

    /**
     * Get mimeId.
    
     *
     * @return integer
     */
    public function getMimeId()
    {
        return $this->mimeId;
    }
}
