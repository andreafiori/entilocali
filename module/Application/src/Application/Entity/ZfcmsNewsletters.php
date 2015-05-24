<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsNewsletters
 *
 * @ORM\Table(name="zfcms_newsletters", uniqueConstraints={@ORM\UniqueConstraint(name="titlo", columns={"title"})}, indexes={@ORM\Index(name="sent", columns={"sent"})})
 * @ORM\Entity
 */
class ZfcmsNewsletters
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
     * @var \DateTime
     *
     * @ORM\Column(name="create_date", type="datetime", nullable=false)
     */
    private $createDate = '0000-00-00 00:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=40, nullable=false)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="sent", type="string", length=25, nullable=false)
     */
    private $sent;



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
     *
     * @return ZfcmsNewsletters
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
     *
     * @return ZfcmsNewsletters
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
     * Set createDate
     *
     * @param \DateTime $createDate
     *
     * @return ZfcmsNewsletters
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
     * Set format
     *
     * @param string $format
     *
     * @return ZfcmsNewsletters
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
     * @param string $sent
     *
     * @return ZfcmsNewsletters
     */
    public function setSent($sent)
    {
        $this->sent = $sent;
    
        return $this;
    }

    /**
     * Get sent
     *
     * @return string
     */
    public function getSent()
    {
        return $this->sent;
    }
}
