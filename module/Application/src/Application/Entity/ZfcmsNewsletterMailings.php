<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsNewsletterMailings
 *
 * @ORM\Table(name="zfcms_newsletter_mailings", indexes={@ORM\Index(name="fk_newsletter_newsl_id", columns={"newsletter_id"})})
 * @ORM\Entity
 */
class ZfcmsNewsletterMailings
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
     * @ORM\Column(name="error_log", type="text", length=65535, nullable=true)
     */
    private $errorLog;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sending_date", type="datetime", nullable=true)
     */
    private $sendingDate;

    /**
     * @var \Application\Entity\ZfcmsNewsletters
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsNewsletters")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="newsletter_id", referencedColumnName="id")
     * })
     */
    private $newsletter;



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
     * Set errorLog
     *
     * @param string $errorLog
     * @return ZfcmsNewsletterMailings
     */
    public function setErrorLog($errorLog)
    {
        $this->errorLog = $errorLog;
    
        return $this;
    }

    /**
     * Get errorLog
     *
     * @return string 
     */
    public function getErrorLog()
    {
        return $this->errorLog;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ZfcmsNewsletterMailings
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set sendingDate
     *
     * @param \DateTime $sendingDate
     * @return ZfcmsNewsletterMailings
     */
    public function setSendingDate($sendingDate)
    {
        $this->sendingDate = $sendingDate;
    
        return $this;
    }

    /**
     * Get sendingDate
     *
     * @return \DateTime 
     */
    public function getSendingDate()
    {
        return $this->sendingDate;
    }

    /**
     * Set newsletter
     *
     * @param \Application\Entity\ZfcmsNewsletters $newsletter
     * @return ZfcmsNewsletterMailings
     */
    public function setNewsletter(\Application\Entity\ZfcmsNewsletters $newsletter = null)
    {
        $this->newsletter = $newsletter;
    
        return $this;
    }

    /**
     * Get newsletter
     *
     * @return \Application\Entity\ZfcmsNewsletters 
     */
    public function getNewsletter()
    {
        return $this->newsletter;
    }
}
