<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterEmails
 *
 * @ORM\Table(name="newsletter_emails", uniqueConstraints={@ORM\UniqueConstraint(name="mails", columns={"email"})})
 * @ORM\Entity
 */
class NewsletterEmails
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
     * @ORM\Column(name="nickname", type="string", length=80, nullable=false)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="format", type="string", length=100, nullable=false)
     */
    private $format;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate = '2014-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="activationdate", type="datetime", nullable=false)
     */
    private $activationdate = '2014-01-01 01:01:01';

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="txtonly", type="integer", nullable=false)
     */
    private $txtonly;



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
     * Set nickname
     *
     * @param string $nickname
     * @return NewsletterEmails
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string 
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return NewsletterEmails
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set format
     *
     * @param string $format
     * @return NewsletterEmails
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
     * Set insertdate
     *
     * @param \DateTime $insertdate
     * @return NewsletterEmails
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
     * Set activationdate
     *
     * @param \DateTime $activationdate
     * @return NewsletterEmails
     */
    public function setActivationdate($activationdate)
    {
        $this->activationdate = $activationdate;

        return $this;
    }

    /**
     * Get activationdate
     *
     * @return \DateTime 
     */
    public function getActivationdate()
    {
        return $this->activationdate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return NewsletterEmails
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
     * Set txtonly
     *
     * @param integer $txtonly
     * @return NewsletterEmails
     */
    public function setTxtonly($txtonly)
    {
        $this->txtonly = $txtonly;

        return $this;
    }

    /**
     * Get txtonly
     *
     * @return integer 
     */
    public function getTxtonly()
    {
        return $this->txtonly;
    }
}
