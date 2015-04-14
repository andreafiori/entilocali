<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsFaqAnswers
 *
 * @ORM\Table(name="zfcms_faq_answers", indexes={@ORM\Index(name="fk_faq_users", columns={"user_id"}), @ORM\Index(name="fk_faq_question_id", columns={"question_id"})})
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
     * @var \Application\Entity\ZfcmsFaqAnswers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsFaqAnswers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     * })
     */
    private $question;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * Set question
     *
     * @param \Application\Entity\ZfcmsFaqAnswers $question
     * @return ZfcmsFaqAnswers
     */
    public function setQuestion(\Application\Entity\ZfcmsFaqAnswers $question = null)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Get question
     *
     * @return \Application\Entity\ZfcmsFaqAnswers 
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\ZfcmsUsers $user
     * @return ZfcmsFaqAnswers
     */
    public function setUser(\Application\Entity\ZfcmsUsers $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUser()
    {
        return $this->user;
    }
}
