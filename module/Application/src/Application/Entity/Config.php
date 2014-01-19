<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Config
 *
 * @ORM\Table(name="config", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="module_id", columns={"module_id"}), @ORM\Index(name="isadmin", columns={"isbackend"}), @ORM\Index(name="isuniversal", columns={"isuniversal"})})
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
     * @ORM\Column(name="isbackend", type="integer", nullable=false)
     */
    private $isbackend;

    /**
     * @var integer
     *
     * @ORM\Column(name="isuniversal", type="integer", nullable=false)
     */
    private $isuniversal = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="module_id", type="integer", nullable=false)
     */
    private $moduleId = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     */
    private $languageId = '1';

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
     * Set isuniversal
     *
     * @param integer $isuniversal
     * @return Config
     */
    public function setIsuniversal($isuniversal)
    {
        $this->isuniversal = $isuniversal;

        return $this;
    }

    /**
     * Get isuniversal
     *
     * @return integer 
     */
    public function getIsuniversal()
    {
        return $this->isuniversal;
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

    /**
     * Set channel
     *
     * @param \Application\Entity\Channels $channel
     * @return Config
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
