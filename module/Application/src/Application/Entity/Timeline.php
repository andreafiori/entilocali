<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeline
 *
 * @ORM\Table(name="timeline")
 * @ORM\Entity
 */
class Timeline
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
     * @var integer
     *
     * @ORM\Column(name="century", type="integer", nullable=true)
     */
    private $century;

    /**
     * @var integer
     *
     * @ORM\Column(name="year", type="integer", nullable=true)
     */
    private $year;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description_lang1", type="text", nullable=true)
     */
    private $descriptionLang1;

    /**
     * @var string
     *
     * @ORM\Column(name="description_lang2", type="text", nullable=true)
     */
    private $descriptionLang2;

    /**
     * @var string
     *
     * @ORM\Column(name="description_lang3", type="text", nullable=true)
     */
    private $descriptionLang3;

    /**
     * @var string
     *
     * @ORM\Column(name="description_lang4", type="text", nullable=true)
     */
    private $descriptionLang4;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="text", nullable=true)
     */
    private $status;



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
     * Set century
     *
     * @param integer $century
     * @return Timeline
     */
    public function setCentury($century)
    {
        $this->century = $century;

        return $this;
    }

    /**
     * Get century
     *
     * @return integer 
     */
    public function getCentury()
    {
        return $this->century;
    }

    /**
     * Set year
     *
     * @param integer $year
     * @return Timeline
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Timeline
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Timeline
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
     * @return Timeline
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
     * Set descriptionLang1
     *
     * @param string $descriptionLang1
     * @return Timeline
     */
    public function setDescriptionLang1($descriptionLang1)
    {
        $this->descriptionLang1 = $descriptionLang1;

        return $this;
    }

    /**
     * Get descriptionLang1
     *
     * @return string 
     */
    public function getDescriptionLang1()
    {
        return $this->descriptionLang1;
    }

    /**
     * Set descriptionLang2
     *
     * @param string $descriptionLang2
     * @return Timeline
     */
    public function setDescriptionLang2($descriptionLang2)
    {
        $this->descriptionLang2 = $descriptionLang2;

        return $this;
    }

    /**
     * Get descriptionLang2
     *
     * @return string 
     */
    public function getDescriptionLang2()
    {
        return $this->descriptionLang2;
    }

    /**
     * Set descriptionLang3
     *
     * @param string $descriptionLang3
     * @return Timeline
     */
    public function setDescriptionLang3($descriptionLang3)
    {
        $this->descriptionLang3 = $descriptionLang3;

        return $this;
    }

    /**
     * Get descriptionLang3
     *
     * @return string 
     */
    public function getDescriptionLang3()
    {
        return $this->descriptionLang3;
    }

    /**
     * Set descriptionLang4
     *
     * @param string $descriptionLang4
     * @return Timeline
     */
    public function setDescriptionLang4($descriptionLang4)
    {
        $this->descriptionLang4 = $descriptionLang4;

        return $this;
    }

    /**
     * Get descriptionLang4
     *
     * @return string 
     */
    public function getDescriptionLang4()
    {
        return $this->descriptionLang4;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Timeline
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
}
