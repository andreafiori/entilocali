<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsTicketsMessages
 *
 * @ORM\Table(name="zfcms_tickets_messages")
 * @ORM\Entity
 */
class ZfcmsTicketsMessages
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
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="send_date", type="datetime", nullable=false)
     */
    private $sendDate = '2010-01-01 01:01:01';

    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_id", type="integer", nullable=false)
     */
    private $ticketId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId = '0';



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
     * Set message
     *
     * @param string $message
     *
     * @return ZfcmsTicketsMessages
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
     * Set sendDate
     *
     * @param \DateTime $sendDate
     *
     * @return ZfcmsTicketsMessages
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
    
        return $this;
    }

    /**
     * Get sendDate
     *
     * @return \DateTime
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }

    /**
     * Set ticketId
     *
     * @param integer $ticketId
     *
     * @return ZfcmsTicketsMessages
     */
    public function setTicketId($ticketId)
    {
        $this->ticketId = $ticketId;
    
        return $this;
    }

    /**
     * Get ticketId
     *
     * @return integer
     */
    public function getTicketId()
    {
        return $this->ticketId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     *
     * @return ZfcmsTicketsMessages
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
