<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterSends
 *
 * @ORM\Table(name="newsletter_sends", indexes={@ORM\Index(name="newsletter_id", columns={"newsletter_id"})})
 * @ORM\Entity
 */
class NewsletterSends
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
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="senddate", type="datetime", nullable=true)
     */
    private $senddate;

    /**
     * @var integer
     *
     * @ORM\Column(name="newsletter_id", type="integer", nullable=true)
     */
    private $newsletterId;



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
     * Set description
     *
     * @param string $description
     * @return NewsletterSends
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
     * Set senddate
     *
     * @param \DateTime $senddate
     * @return NewsletterSends
     */
    public function setSenddate($senddate)
    {
        $this->senddate = $senddate;

        return $this;
    }

    /**
     * Get senddate
     *
     * @return \DateTime 
     */
    public function getSenddate()
    {
        return $this->senddate;
    }

    /**
     * Set newsletterId
     *
     * @param integer $newsletterId
     * @return NewsletterSends
     */
    public function setNewsletterId($newsletterId)
    {
        $this->newsletterId = $newsletterId;

        return $this;
    }

    /**
     * Get newsletterId
     *
     * @return integer 
     */
    public function getNewsletterId()
    {
        return $this->newsletterId;
    }
}
