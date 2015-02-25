<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsFaqAnswers
 *
 * @ORM\Table(name="zfcms_faq_answers", indexes={@ORM\Index(name="question_id", columns={"question_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class ZfcmsFaqAnswers
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
     * @ORM\Column(name="answer", type="text", length=65535, nullable=false)
     */
    private $answer;

    /**
     * @var integer
     *
     * @ORM\Column(name="rate", type="bigint", nullable=false)
     */
    private $rate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     */
    private $lastUpdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="question_id", type="bigint", nullable=false)
     */
    private $questionId;

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
     * Set answer
     *
     * @param string $answer
     * @return ZfcmsFaqAnswers
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set rate
     *
     * @param integer $rate
     * @return ZfcmsFaqAnswers
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
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return ZfcmsFaqAnswers
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return ZfcmsFaqAnswers
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
     * Set questionId
     *
     * @param integer $questionId
     * @return ZfcmsFaqAnswers
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    
        return $this;
    }

    /**
     * Get questionId
     *
     * @return integer 
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return ZfcmsFaqAnswers
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
