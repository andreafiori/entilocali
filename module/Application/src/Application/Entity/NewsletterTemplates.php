<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterTemplates
 *
 * @ORM\Table(name="newsletter_templates", indexes={@ORM\Index(name="channel_id", columns={"channel_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="predefined", columns={"predefined"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class NewsletterTemplates
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
     * @ORM\Column(name="templatename", type="string", length=80, nullable=false)
     */
    private $templatename;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=100, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="cssfile", type="string", length=100, nullable=false)
     */
    private $cssfile;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=150, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", nullable=false)
     */
    private $format = 'html';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdate", type="datetime", nullable=false)
     */
    private $createdate = '0000-00-00 00:00:00';

    /**
     * @var integer
     *
     * @ORM\Column(name="position", type="bigint", nullable=false)
     */
    private $position = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="predefined", type="bigint", nullable=false)
     */
    private $predefined = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="language_id", type="bigint", nullable=false)
     */
    private $languageId = '1';

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
     * Set templatename
     *
     * @param string $templatename
     * @return NewsletterTemplates
     */
    public function setTemplatename($templatename)
    {
        $this->templatename = $templatename;

        return $this;
    }

    /**
     * Get templatename
     *
     * @return string 
     */
    public function getTemplatename()
    {
        return $this->templatename;
    }

    /**
     * Set filename
     *
     * @param string $filename
     * @return NewsletterTemplates
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
     * Set cssfile
     *
     * @param string $cssfile
     * @return NewsletterTemplates
     */
    public function setCssfile($cssfile)
    {
        $this->cssfile = $cssfile;

        return $this;
    }

    /**
     * Get cssfile
     *
     * @return string 
     */
    public function getCssfile()
    {
        return $this->cssfile;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return NewsletterTemplates
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return NewsletterTemplates
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
     * Set createdate
     *
     * @param \DateTime $createdate
     * @return NewsletterTemplates
     */
    public function setCreatedate($createdate)
    {
        $this->createdate = $createdate;

        return $this;
    }

    /**
     * Get createdate
     *
     * @return \DateTime 
     */
    public function getCreatedate()
    {
        return $this->createdate;
    }

    /**
     * Set position
     *
     * @param integer $position
     * @return NewsletterTemplates
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
     * Set status
     *
     * @param string $status
     * @return NewsletterTemplates
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
     * Set predefined
     *
     * @param integer $predefined
     * @return NewsletterTemplates
     */
    public function setPredefined($predefined)
    {
        $this->predefined = $predefined;

        return $this;
    }

    /**
     * Get predefined
     *
     * @return integer 
     */
    public function getPredefined()
    {
        return $this->predefined;
    }

    /**
     * Set languageId
     *
     * @param integer $languageId
     * @return NewsletterTemplates
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
     * @return NewsletterTemplates
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
