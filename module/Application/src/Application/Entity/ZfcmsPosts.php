<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPosts
 *
 * @ORM\Table(name="zfcms_posts", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="flag_allegati", columns={"flag_attachments"}), @ORM\Index(name="fk_posts_user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ZfcmsPosts
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
     * @ORM\Column(name="note", type="string", length=80, nullable=true)
     */
    private $note;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expire_date", type="datetime", nullable=false)
     */
    private $expireDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     */
    private $lastUpdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="flag_attachments", type="integer", nullable=true)
     */
    private $flagAttachments;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private $parentId;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set note
     *
     * @param string $note
     * @return ZfcmsPosts
     */
    public function setNote($note)
    {
        $this->note = $note;
    
        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return ZfcmsPosts
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set expireDate
     *
     * @param \DateTime $expireDate
     * @return ZfcmsPosts
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
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return ZfcmsPosts
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set flagAttachments
     *
     * @param integer $flagAttachments
     * @return ZfcmsPosts
     */
    public function setFlagAttachments($flagAttachments)
    {
        $this->flagAttachments = $flagAttachments;
    
        return $this;
    }

    /**
     * Get flagAttachments
     *
     * @return integer 
     */
    public function getFlagAttachments()
    {
        return $this->flagAttachments;
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return ZfcmsPosts
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\ZfcmsUsers $user
     * @return ZfcmsPosts
     */
    public function setUser(\Application\Entity\ZfcmsUsers $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUser()
    {
        return $this->user;
    }
}
