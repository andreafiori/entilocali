<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsTicketsMessages
 *
 * @ORM\Table(name="zfcms_tickets_messages", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="ticket_id", columns={"ticket_id"})})
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
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate = '2014-01-01 01:01:01';

    /**
     * @var integer
     *
     * @ORM\Column(name="ticket_id", type="bigint", nullable=false)
     */
    private $ticketId = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
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
     * Set insertDate
     *
     * @param \DateTime $insertDate
     *
     * @return ZfcmsTicketsMessages
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
