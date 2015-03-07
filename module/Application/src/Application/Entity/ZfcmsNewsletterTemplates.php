<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsNewsletterTemplates
 *
 * @ORM\Table(name="zfcms_newsletter_templates")
 * @ORM\Entity
 */
class ZfcmsNewsletterTemplates
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
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="descriziption", type="string", length=150, nullable=false)
     */
    private $descriziption;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", nullable=false)
     */
    private $format = 'html';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=false)
     */
    private $creationdate = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=false)
     */
    private $position = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="integer", nullable=false)
     */
    private $languageId = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="channel_id", type="integer", nullable=false)
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
     * Set name
     *
     * @param string $name
     * @return ZfcmsNewsletterTemplates
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
     * Set filename
     *
     * @param string $filename
     * @return ZfcmsNewsletterTemplates
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;
    
        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set descriziption
     *
     * @param string $descriziption
     * @return ZfcmsNewsletterTemplates
     */
    public function setDescriziption($descriziption)
    {
        $this->descriziption = $descriziption;
    
        return $this;
    }

    /**
     * Get descriziption
     *
     * @return string 
     */
    public function getDescriziption()
    {
        return $this->descriziption;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return ZfcmsNewsletterTemplates
     */
    public function setFormat($format)
    {
        $this->format = $format;
    
        return $this;
    }

    /**
     * Get format
     *
     * @return string 
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Set creationdate
     *
     * @param \DateTime $creationdate
     * @return ZfcmsNewsletterTemplates
     */
    public function setCreationdate($creationdate)
    {
        $this->creationdate = $creationdate;
    
        return $this;
    }

    /**
     * Get creationdate
     *
     * @return \DateTime 
     */
    public function getCreationdate()
    {
        return $this->creationdate;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return ZfcmsNewsletterTemplates
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
     * Set languageId
     *
     * @param integer $languageId
     * @return ZfcmsNewsletterTemplates
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
     * Set channelId
     *
     * @param integer $channelId
     * @return ZfcmsNewsletterTemplates
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
