<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsPosts
 *
 * @ORM\Table(name="zfcms_posts", indexes={@ORM\Index(name="parent_id", columns={"parent_id"}), @ORM\Index(name="alias", columns={"alias"}), @ORM\Index(name="flag_allegati", columns={"flag_attachments"})})
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
     * @ORM\Column(name="parent_id", type="bigint", nullable=false)
     */
    private $parentId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=40, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=40, nullable=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="flag_attachments", type="string", nullable=false)
     */
    private $flagAttachments;



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
     *
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
     *
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
     *
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
     *
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
     * Set parentId
     *
     * @param integer $parentId
     *
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
     * Set type
     *
     * @param string $type
     *
     * @return ZfcmsPosts
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set alias
     *
     * @param string $alias
     *
     * @return ZfcmsPosts
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    
        return $this;
    }

    /**
     * Get alias
     *
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set flagAttachments
     *
     * @param string $flagAttachments
     *
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
     * @return string
     */
    public function getFlagAttachments()
    {
        return $this->flagAttachments;
    }
}
