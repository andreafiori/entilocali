<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts")
 * @ORM\Entity
 */
class Posts
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
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="date", nullable=false)
     */
    private $insertdate = '2013-01-01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate_time", type="time", nullable=false)
     */
    private $insertdateTime = '00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="date", nullable=false)
     */
    private $expiredate = '2030-02-10';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiretime", type="time", nullable=false)
     */
    private $expiretime = '13:30:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="date", nullable=false)
     */
    private $lastupdate = '2030-02-10';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate_time", type="time", nullable=false)
     */
    private $lastupdateTime = '13:30:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="parentid", type="integer", nullable=false)
     */
    private $parentid = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="integer", nullable=false)
     */
    private $position = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="forcedurl", type="string", length=150, nullable=false)
     */
    private $forcedurl = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=80, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="typeofpost", type="string", length=80, nullable=false)
     */
    private $typeofpost;

    /**
     * @var string
     *
     * @ORM\Column(name="templatefile", type="string", length=80, nullable=false)
     */
    private $templatefile;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=50, nullable=false)
     */
    private $alias;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';



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
     * Set insertdate
     *
     * @param \DateTime $insertdate
     * @return Posts
     */
    public function setInsertdate($insertdate)
    {
        $this->insertdate = $insertdate;

        return $this;
    }

    /**
     * Get insertdate
     *
     * @return \DateTime 
     */
    public function getInsertdate()
    {
        return $this->insertdate;
    }

    /**
     * Set insertdateTime
     *
     * @param \DateTime $insertdateTime
     * @return Posts
     */
    public function setInsertdateTime($insertdateTime)
    {
        $this->insertdateTime = $insertdateTime;

        return $this;
    }

    /**
     * Get insertdateTime
     *
     * @return \DateTime 
     */
    public function getInsertdateTime()
    {
        return $this->insertdateTime;
    }

    /**
     * Set expiredate
     *
     * @param \DateTime $expiredate
     * @return Posts
     */
    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;

        return $this;
    }

    /**
     * Get expiredate
     *
     * @return \DateTime 
     */
    public function getExpiredate()
    {
        return $this->expiredate;
    }

    /**
     * Set expiretime
     *
     * @param \DateTime $expiretime
     * @return Posts
     */
    public function setExpiretime($expiretime)
    {
        $this->expiretime = $expiretime;

        return $this;
    }

    /**
     * Get expiretime
     *
     * @return \DateTime 
     */
    public function getExpiretime()
    {
        return $this->expiretime;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     * @return Posts
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime 
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * Set lastupdateTime
     *
     * @param \DateTime $lastupdateTime
     * @return Posts
     */
    public function setLastupdateTime($lastupdateTime)
    {
        $this->lastupdateTime = $lastupdateTime;

        return $this;
    }

    /**
     * Get lastupdateTime
     *
     * @return \DateTime 
     */
    public function getLastupdateTime()
    {
        return $this->lastupdateTime;
    }

    /**
     * Set parentid
     *
     * @param integer $parentid
     * @return Posts
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;

        return $this;
    }

    /**
     * Get parentid
     *
     * @return integer 
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return Posts
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
     * Set forcedurl
     *
     * @param string $forcedurl
     * @return Posts
     */
    public function setForcedurl($forcedurl)
    {
        $this->forcedurl = $forcedurl;

        return $this;
    }

    /**
     * Get forcedurl
     *
     * @return string 
     */
    public function getForcedurl()
    {
        return $this->forcedurl;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Posts
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
     * Set typeofpost
     *
     * @param string $typeofpost
     * @return Posts
     */
    public function setTypeofpost($typeofpost)
    {
        $this->typeofpost = $typeofpost;

        return $this;
    }

    /**
     * Get typeofpost
     *
     * @return string 
     */
    public function getTypeofpost()
    {
        return $this->typeofpost;
    }

    /**
     * Set templatefile
     *
     * @param string $templatefile
     * @return Posts
     */
    public function setTemplatefile($templatefile)
    {
        $this->templatefile = $templatefile;

        return $this;
    }

    /**
     * Get templatefile
     *
     * @return string 
     */
    public function getTemplatefile()
    {
        return $this->templatefile;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Posts
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
     * Set userId
     *
     * @param integer $userId
     * @return Posts
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
