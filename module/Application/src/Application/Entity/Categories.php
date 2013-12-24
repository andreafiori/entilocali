<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="module_id", columns={"module_id"})})
 * @ORM\Entity
 */
class Categories
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
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="orderfieldname", type="string", length=100, nullable=true)
     */
    private $orderfieldname;

    /**
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=4, nullable=true)
     */
    private $accesskey;

    /**
     * @var string
     *
     * @ORM\Column(name="templatefile", type="string", length=100, nullable=true)
     */
    private $templatefile;

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
    private $position = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     */
    private $moduleId = '0';

    /**
     * @var \Application\Entity\Channels
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Channels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     * })
     */
    private $channel;



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
     * Set status
     *
     * @param string $status
     * @return Categories
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
     * Set orderfieldname
     *
     * @param string $orderfieldname
     * @return Categories
     */
    public function setOrderfieldname($orderfieldname)
    {
        $this->orderfieldname = $orderfieldname;

        return $this;
    }

    /**
     * Get orderfieldname
     *
     * @return string 
     */
    public function getOrderfieldname()
    {
        return $this->orderfieldname;
    }

    /**
     * Set accesskey
     *
     * @param string $accesskey
     * @return Categories
     */
    public function setAccesskey($accesskey)
    {
        $this->accesskey = $accesskey;

        return $this;
    }

    /**
     * Get accesskey
     *
     * @return string 
     */
    public function getAccesskey()
    {
        return $this->accesskey;
    }

    /**
     * Set templatefile
     *
     * @param string $templatefile
     * @return Categories
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
     * Set parentid
     *
     * @param integer $parentid
     * @return Categories
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
     * @return Categories
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
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Categories
     */
    public function setModuleId($moduleId)
    {
        $this->moduleId = $moduleId;

        return $this;
    }

    /**
     * Get moduleId
     *
     * @return integer 
     */
    public function getModuleId()
    {
        return $this->moduleId;
    }

    /**
     * Set channel
     *
     * @param \Application\Entity\Channels $channel
     * @return Categories
     */
    public function setChannel(\Application\Entity\Channels $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Application\Entity\Channels 
     */
    public function getChannel()
    {
        return $this->channel;
    }
}
