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
    private $code = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId = '1';



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
     * Set code.
    
     *
     * @param string $code
     *
     * @return ZfcmsModules
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code.
    
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set status.
    
     *
     * @param string $status
     *
     * @return ZfcmsModules
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status.
    
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set channelId.
    
     *
     * @param integer $channelId
     *
     * @return ZfcmsModules
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    
        return $this;
    }

    /**
     * Get channelId.
    
     *
     * @return integer
     */
    public function getChannelId()
    {
        return $this->channelId;
    }
}
