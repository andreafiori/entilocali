<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FaqDomande
 *
 * @ORM\Table(name="faq_domande", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="language_id", columns={"language_id"}), @ORM\Index(name="channel_id", columns={"channel_id"})})
 * @ORM\Entity
 */
class FaqDomande
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
     * @ORM\Column(name="question", type="text", length=65535, nullable=false)
     */
    private $question;

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
     * @ORM\Column(name="rate", type="bigint", nullable=false)
     */
    private $rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate;

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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;



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
     * Set question
     *
     * @param string $question
     *
     * @return FaqDomande
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return string
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set position
     *
     * @param integer $position
     *
     * @return FaqDomande
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
     *
     * @return FaqDomande
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
     * Set rate
     *
     * @param integer $rate
     *
     * @return FaqDomande
     */
    public function setRate($rate)
    {
        $this->rate = $rate;
    
        return $this;
    }

    /**
     * Get rate
     *
     * @return integer
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set insertdate
     *
     * @param \DateTime $insertdate
     *
     * @return FaqDomande
     */
    public function setInsertdate($insertdate)
    {
        $this->insertdate = $insertdate;
    
        return $this;
    }

    /**
     * Get insertdate
     *
     * @return \DateTime
     */
    public function getInsertdate()
    {
        return $this->insertdate;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     *
     * @return FaqDomande
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;
    
        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }

    /**
     * Set channelId
     *
     * @param integer $channelId
     *
     * @return FaqDomande
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
     * @return FaqDomande
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return FaqDomande
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
