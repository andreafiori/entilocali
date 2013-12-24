<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Posts
 *
 * @ORM\Table(name="posts", indexes={@ORM\Index(name="srchfields", columns={"user_id", "parentid"}), @ORM\Index(name="IDX_885DBAFAA76ED395", columns={"user_id"})})
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
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate = '2013-01-01 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="datetime", nullable=false)
     */
    private $expiredate = '2030-02-10 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate = '2030-02-10 00:00:00';

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
     * @var \Application\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Users")
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
     * Set user
     *
     * @param \Application\Entity\Users $user
     * @return Posts
     */
    public function setUser(\Application\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\Users 
     */
    public function getUser()
    {
        return $this->user;
    }
}
