<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter", uniqueConstraints={@ORM\UniqueConstraint(name="titlo", columns={"title"})}, indexes={@ORM\Index(name="category_id", columns={"category_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class Newsletter
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdate", type="datetime", nullable=false)
     */
    private $createdate = '0000-00-00 00:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentdate", type="datetime", nullable=false)
     */
    private $sentdate = '2010-01-01 01:01:00';

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=40, nullable=false)
     */
    private $format;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status = 'no';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=false)
     */
    private $categoryId = '0';

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
     * Set title
     *
     * @param string $title
     * @return Newsletter
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
     * Set message
     *
     * @param string $message
     * @return Newsletter
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set createdate
     *
     * @param \DateTime $createdate
     * @return Newsletter
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
     * Set sentdate
     *
     * @param \DateTime $sentdate
     * @return Newsletter
     */
    public function setSentdate($sentdate)
    {
        $this->sentdate = $sentdate;

        return $this;
    }

    /**
     * Get sentdate
     *
     * @return \DateTime 
     */
    public function getSentdate()
    {
        return $this->sentdate;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return Newsletter
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
     * Set status
     *
     * @param string $status
     * @return Newsletter
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Newsletter
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     * @return Newsletter
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
