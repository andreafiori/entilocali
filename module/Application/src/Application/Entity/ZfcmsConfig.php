<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsConfig
 *
 * @ORM\Table(name="zfcms_config", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="isadmin", columns={"is_backend"}), @ORM\Index(name="isalwaysallowed", columns={"is_always_allowed"})})
 * @ORM\Entity
 */
class ZfcmsConfig
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
     * @ORM\Column(name="value", type="text", length=65535, nullable=true)
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
     * @ORM\Column(name="is_backend", type="bigint", nullable=false)
     */
    private $isBackend;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_always_allowed", type="bigint", nullable=false)
     */
    private $isAlwaysAllowed;

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="bigint", nullable=false)
     */
    private $moduleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="bigint", nullable=false)
     */
    private $channelId;

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="bigint", nullable=false)
     */
    private $languageId;



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
     *
     * @return ZfcmsConfig
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
     *
     * @return ZfcmsConfig
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
     *
     * @return ZfcmsConfig
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
     * Set isBackend
     *
     * @param integer $isBackend
     *
     * @return ZfcmsConfig
     */
    public function setIsBackend($isBackend)
    {
        $this->isBackend = $isBackend;
    
        return $this;
    }

    /**
     * Get isBackend
     *
     * @return integer
     */
    public function getIsBackend()
    {
        return $this->isBackend;
    }

    /**
     * Set isAlwaysAllowed
     *
     * @param integer $isAlwaysAllowed
     *
     * @return ZfcmsConfig
     */
    public function setIsAlwaysAllowed($isAlwaysAllowed)
    {
        $this->isAlwaysAllowed = $isAlwaysAllowed;
    
        return $this;
    }

    /**
     * Get isAlwaysAllowed
     *
     * @return integer
     */
    public function getIsAlwaysAllowed()
    {
        return $this->isAlwaysAllowed;
    }

    /**
     * Set moduleId
     *
     * @param integer $moduleId
     *
     * @return ZfcmsConfig
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
     *
     * @return ZfcmsConfig
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
     *
     * @return ZfcmsConfig
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
