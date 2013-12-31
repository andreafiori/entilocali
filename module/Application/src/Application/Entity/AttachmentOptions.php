<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AttachmentOptions
 *
 * @ORM\Table(name="attachment_options")
 * @ORM\Entity
 */
class AttachmentOptions
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
     * @ORM\Column(name="filetitle", type="string", length=50, nullable=true)
     */
    private $filetitle;

    /**
     * @var string
     *
     * @ORM\Column(name="filedescription", type="string", length=50, nullable=true)
     */
    private $filedescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifattachment", type="integer", nullable=true)
     */
    private $rifattachment;



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
     * Set filetitle
     *
     * @param string $filetitle
     * @return AttachmentOptions
     */
    public function setFiletitle($filetitle)
    {
        $this->filetitle = $filetitle;

        return $this;
    }

    /**
     * Get filetitle
     *
     * @return string 
     */
    public function getFiletitle()
    {
        return $this->filetitle;
    }

    /**
     * Set filedescription
     *
     * @param string $filedescription
     * @return AttachmentOptions
     */
    public function setFiledescription($filedescription)
    {
        $this->filedescription = $filedescription;

        return $this;
    }

    /**
     * Get filedescription
     *
     * @return string 
     */
    public function getFiledescription()
    {
        return $this->filedescription;
    }

    /**
     * Set rifattachment
     *
     * @param integer $rifattachment
     * @return AttachmentOptions
     */
    public function setRifattachment($rifattachment)
    {
        $this->rifattachment = $rifattachment;

        return $this;
    }

    /**
     * Get rifattachment
     *
     * @return integer 
     */
    public function getRifattachment()
    {
        return $this->rifattachment;
    }
}
