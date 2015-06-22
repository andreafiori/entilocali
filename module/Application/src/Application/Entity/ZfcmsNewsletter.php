<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsNewsletter
 *
 * @ORM\Table(name="zfcms_newsletter", uniqueConstraints={@ORM\UniqueConstraint(name="titlo", columns={"title"})}, indexes={@ORM\Index(name="sent", columns={"sent"}), @ORM\Index(name="fk_newsletter_template_id", columns={"template_id"})})
 * @ORM\Entity
 */
class ZfcmsNewsletter
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
     * @ORM\Column(name="title", type="string", length=100, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="message_text", type="text", length=65535, nullable=false)
     */
    private $messageText;

    /**
     * @var string
     *
     * @ORM\Column(name="message_sent", type="text", length=65535, nullable=false)
     */
    private $messageSent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     */
    private $lastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=40, nullable=false)
     */
    private $format;

    /**
     * @var integer
     *
     * @ORM\Column(name="sent", type="integer", nullable=false)
     */
    private $sent;

    /**
     * @var \Application\Entity\ZfcmsNewsletterTemplates
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsNewsletterTemplates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     * })
     */
    private $template;



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
     * Set title
     *
     * @param string $title
     * @return ZfcmsNewsletter
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set messageText
     *
     * @param string $messageText
     * @return ZfcmsNewsletter
     */
    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
    
        return $this;
    }

    /**
     * Get messageText
     *
     * @return string 
     */
    public function getMessageText()
    {
        return $this->messageText;
    }

    /**
     * Set messageSent
     *
     * @param string $messageSent
     * @return ZfcmsNewsletter
     */
    public function setMessageSent($messageSent)
    {
        $this->messageSent = $messageSent;
    
        return $this;
    }

    /**
     * Get messageSent
     *
     * @return string 
     */
    public function getMessageSent()
    {
        return $this->messageSent;
    }

    /**
     * Set createDate
     *
     * @param \DateTime $createDate
     * @return ZfcmsNewsletter
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    
        return $this;
    }

    /**
     * Get createDate
     *
     * @return \DateTime 
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return ZfcmsNewsletter
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return ZfcmsNewsletter
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
     * Set sent
     *
     * @param integer $sent
     * @return ZfcmsNewsletter
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    
        return $this;
    }

    /**
     * Get sent
     *
     * @return integer 
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set template
     *
     * @param \Application\Entity\ZfcmsNewsletterTemplates $template
     * @return ZfcmsNewsletter
     */
    public function setTemplate(\Application\Entity\ZfcmsNewsletterTemplates $template = null)
    {
        $this->template = $template;
    
        return $this;
    }

    /**
     * Get template
     *
     * @return \Application\Entity\ZfcmsNewsletterTemplates 
     */
    public function getTemplate()
    {
        return $this->template;
    }
}
