<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @ORM\Table(name="languages", indexes={@ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class Languages
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
     * @ORM\Column(name="flag", type="string", length=60, nullable=false)
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation1", type="string", length=60, nullable=false)
     */
    private $abbreviation1;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation2", type="string", length=60, nullable=false)
     */
    private $abbreviation2;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation3", type="string", length=60, nullable=false)
     */
    private $abbreviation3;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_default", type="bigint", nullable=false)
     */
    private $isDefault = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="is_default_backend", type="bigint", nullable=false)
     */
    private $isDefaultBackend = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encoding", type="string", length=50, nullable=true)
     */
    private $encoding = 'UTF-8';

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="bigint", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId = '1';



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
     * Set flag
     *
     * @param string $flag
     *
     * @return Languages
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;
    
        return $this;
    }

    /**
     * Get flag
     *
     * @return string
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Languages
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
     * Set abbreviation1
     *
     * @param string $abbreviation1
     *
     * @return Languages
     */
    public function setAbbreviation1($abbreviation1)
    {
        $this->abbreviation1 = $abbreviation1;
    
        return $this;
    }

    /**
     * Get abbreviation1
     *
     * @return string
     */
    public function getAbbreviation1()
    {
        return $this->abbreviation1;
    }

    /**
     * Set abbreviation2
     *
     * @param string $abbreviation2
     *
     * @return Languages
     */
    public function setAbbreviation2($abbreviation2)
    {
        $this->abbreviation2 = $abbreviation2;
    
        return $this;
    }

    /**
     * Get abbreviation2
     *
     * @return string
     */
    public function getAbbreviation2()
    {
        return $this->abbreviation2;
    }

    /**
     * Set abbreviation3
     *
     * @param string $abbreviation3
     *
     * @return Languages
     */
    public function setAbbreviation3($abbreviation3)
    {
        $this->abbreviation3 = $abbreviation3;
    
        return $this;
    }

    /**
     * Get abbreviation3
     *
     * @return string
     */
    public function getAbbreviation3()
    {
        return $this->abbreviation3;
    }

    /**
     * Set isDefault
     *
     * @param integer $isDefault
     *
     * @return Languages
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;
    
        return $this;
    }

    /**
     * Get isDefault
     *
     * @return integer
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }

    /**
     * Set isDefaultBackend
     *
     * @param integer $isDefaultBackend
     *
     * @return Languages
     */
    public function setIsDefaultBackend($isDefaultBackend)
    {
        $this->isDefaultBackend = $isDefaultBackend;
    
        return $this;
    }

    /**
     * Get isDefaultBackend
     *
     * @return integer
     */
    public function getIsDefaultBackend()
    {
        return $this->isDefaultBackend;
    }

    /**
     * Set encoding
     *
     * @param string $encoding
     *
     * @return Languages
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;
    
        return $this;
    }

    /**
     * Get encoding
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return Languages
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     *
     * @return Languages
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
