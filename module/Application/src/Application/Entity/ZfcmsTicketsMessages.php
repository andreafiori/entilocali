<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsTicketsMessages
 *
 * @ORM\Table(name="zfcms_tickets_messages", indexes={@ORM\Index(name="ticket_msg_tkt_id", columns={"ticket_id"}), @ORM\Index(name="ticket_msg_tkt_user_id", columns={"user_id"})})
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
    private $insertDate;

    /**
     * @var \Application\Entity\ZfcmsTickets
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsTickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticket_id", referencedColumnName="id")
     * })
     */
    private $ticket;

    /**
     * @var \Application\Entity\ZfcmsTickets
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsTickets")
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
     * Set ticket
     *
     * @param \Application\Entity\ZfcmsTickets $ticket
     *
     * @return ZfcmsTicketsMessages
     */
    public function setTicket(\Application\Entity\ZfcmsTickets $ticket = null)
    {
        $this->ticket = $ticket;
    
        return $this;
    }

    /**
     * Get ticket
     *
     * @return \Application\Entity\ZfcmsTickets
     */
    public function getTicket()
    {
        return $this->ticket;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\ZfcmsTickets $user
     *
     * @return ZfcmsTicketsMessages
     */
    public function setUser(\Application\Entity\ZfcmsTickets $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\ZfcmsTickets
     */
    public function getUser()
    {
        return $this->user;
    }
}
