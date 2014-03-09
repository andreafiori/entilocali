<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="isadmin", columns={"isbackend"}), @ORM\Index(name="isalwaysallowed", columns={"isalwaysallowed"})})
 * @ORM\Entity
 */
class Config
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
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="text", nullable=true)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="string", length=100, nullable=true)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="isbackend", type="bigint", nullable=false)
     */
    private $isbackend;

    /**
     * @var integer
     *
     * @ORM\Column(name="isalwaysallowed", type="bigint", nullable=false)
     */
    private $isalwaysallowed = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=false)
     */
    private $moduleId = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="bigint", nullable=false)
     */
    private $languageId = '1';



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
     * Set name
     *
     * @param string $name
     * @return Config
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
     * Set value
     *
     * @param string $value
     * @return Config
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Config
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
     * Set isbackend
     *
     * @param integer $isbackend
     * @return Config
     */
    public function setIsbackend($isbackend)
    {
        $this->isbackend = $isbackend;

        return $this;
    }

    /**
     * Get isbackend
     *
     * @return integer 
     */
    public function getIsbackend()
    {
        return $this->isbackend;
    }

    /**
     * Set isalwaysallowed
     *
     * @param integer $isalwaysallowed
     * @return Config
     */
    public function setIsalwaysallowed($isalwaysallowed)
    {
        $this->isalwaysallowed = $isalwaysallowed;

        return $this;
    }

    /**
     * Get isalwaysallowed
     *
     * @return integer 
     */
    public function getIsalwaysallowed()
    {
        return $this->isalwaysallowed;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     * @return Config
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
     * Set channelId
     *
     * @param integer $channelId
     * @return Config
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

    /**
     * Set languageId
     *
     * @param integer $languageId
     * @return Config
     */
    public function setLanguageId($languageId)
    {
        $this->languageId = $languageId;

        return $this;
    }

    /**
     * Get languageId
     *
     * @return integer 
     */
    public function getLanguageId()
    {
        return $this->languageId;
    }
}
