<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimelineOptions
 *
 * @ORM\Table(name="timeline_options", indexes={@ORM\Index(name="timeline_id", columns={"timeline_id"}), @ORM\Index(name="language_id", columns={"language_id"})})
 * @ORM\Entity
 */
class TimelineOptions
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
     * @ORM\Column(name="image", type="string", length=80, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=80, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=80, nullable=true)
     */
    private $status;

    /**
     * @var \Application\Entity\Languages
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Languages")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="language_id", referencedColumnName="id")
     * })
     */
    private $language;

    /**
     * @var \Application\Entity\Timeline
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Timeline")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="timeline_id", referencedColumnName="id")
     * })
     */
    private $timeline;



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
     * Set image
     *
     * @param string $image
     * @return TimelineOptions
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return TimelineOptions
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
     * Set description
     *
     * @param string $description
     * @return TimelineOptions
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
     * Set status
     *
     * @param string $status
     * @return TimelineOptions
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
     * Set language
     *
     * @param \Application\Entity\Languages $language
     * @return TimelineOptions
     */
    public function setLanguage(\Application\Entity\Languages $language = null)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return \Application\Entity\Languages 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set timeline
     *
     * @param \Application\Entity\Timeline $timeline
     * @return TimelineOptions
     */
    public function setTimeline(\Application\Entity\Timeline $timeline = null)
    {
        $this->timeline = $timeline;

        return $this;
    }

    /**
     * Get timeline
     *
     * @return \Application\Entity\Timeline 
     */
    public function getTimeline()
    {
        return $this->timeline;
    }
}
