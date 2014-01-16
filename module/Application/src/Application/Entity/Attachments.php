<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attachments
 *
 * @ORM\Table(name="attachments")
 * @ORM\Entity
 */
class Attachments
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
     * @ORM\Column(name="filename", type="string", length=100, nullable=false)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="filetype", type="string", length=100, nullable=false)
     */
    private $filetype;

    /**
     * @var string
     *
     * @ORM\Column(name="filesize", type="string", length=60, nullable=false)
     */
    private $filesize;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=50, nullable=true)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insertdate", type="datetime", nullable=false)
     */
    private $insertdate = '2013-01-01 01:01:01';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=false)
     */
    private $lastupdate = '2013-01-01 01:01:01';



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
     * Set filename
     *
     * @param string $filename
     * @return Attachments
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filetype
     *
     * @param string $filetype
     * @return Attachments
     */
    public function setFiletype($filetype)
    {
        $this->filetype = $filetype;

        return $this;
    }

    /**
     * Get filetype
     *
     * @return string 
     */
    public function getFiletype()
    {
        return $this->filetype;
    }

    /**
     * Set filesize
     *
     * @param string $filesize
     * @return Attachments
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return string 
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Attachments
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
     * Set insertdate
     *
     * @param \DateTime $insertdate
     * @return Attachments
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
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     * @return Attachments
     */
    public function setLastupdate($lastupdate)
    {
        $this->lastupdate = $lastupdate;

        return $this;
    }

    /**
     * Get lastupdate
     *
     * @return \DateTime 
     */
    public function getLastupdate()
    {
        return $this->lastupdate;
    }
}
