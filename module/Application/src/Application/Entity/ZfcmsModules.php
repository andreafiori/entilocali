<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsModules
 *
 * @ORM\Table(name="zfcms_modules", indexes={@ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class ZfcmsModules
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
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="accesskey", type="string", length=100, nullable=false)
     */
    private $accesskey;

    /**
     * @var integer
     *
     * @ORM\Column(name="front", type="smallint", nullable=false)
     */
    private $front;

    /**
     * @var integer
     *
     * @ORM\Column(name="ordine", type="integer", nullable=false)
     */
    private $ordine;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId;



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
     * Set code
     *
     * @param string $code
     * @return ZfcmsModules
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ZfcmsModules
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ZfcmsModules
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
     * Set accesskey
     *
     * @param string $accesskey
     * @return ZfcmsModules
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
     * Set front
     *
     * @param integer $front
     * @return ZfcmsModules
     */
    public function setFront($front)
    {
        $this->front = $front;
    
        return $this;
    }

    /**
     * Get front
     *
     * @return integer 
     */
    public function getFront()
    {
        return $this->front;
    }

    /**
     * Set ordine
     *
     * @param integer $ordine
     * @return ZfcmsModules
     */
    public function setOrdine($ordine)
    {
        $this->ordine = $ordine;
    
        return $this;
    }

    /**
     * Get ordine
     *
     * @return integer 
     */
    public function getOrdine()
    {
        return $this->ordine;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     * @return ZfcmsModules
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    
        return $this;
    }

    /**
     * Get channelId
     *
     * @return integer 
     */
    public function getChannelId()
    {
        return $this->channelId;
    }
}
