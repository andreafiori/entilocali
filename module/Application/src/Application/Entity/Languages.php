<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @ORM\Table(name="languages", indexes={@ORM\Index(name="srchfields", columns={"channel_id", "abbreviation1"}), @ORM\Index(name="active", columns={"active"}), @ORM\Index(name="IDX_A0D1537972F5A1AA", columns={"channel_id"})})
 * @ORM\Entity
 */
class Languages
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
     * @ORM\Column(name="flag", type="string", length=60, nullable=false)
     */
    private $flag;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=60, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation1", type="string", length=60, nullable=false)
     */
    private $abbreviation1;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation2", type="string", length=60, nullable=false)
     */
    private $abbreviation2;

    /**
     * @var string
     *
     * @ORM\Column(name="abbreviation3", type="string", length=60, nullable=false)
     */
    private $abbreviation3;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isdefault", type="boolean", nullable=false)
     */
    private $isdefault = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="isdefault_backend", type="boolean", nullable=false)
     */
    private $isdefaultBackend = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="encoding", type="string", length=50, nullable=true)
     */
    private $encoding = 'UTF-8';

    /**
     * @var integer
     *
     * @ORM\Column(name="active", type="integer", nullable=false)
     */
    private $active;

    /**
     * @var \Application\Entity\Channels
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\Channels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="channel_id", referencedColumnName="id")
     * })
     */
    private $channel;



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
     * Set flag
     *
     * @param string $flag
     * @return Languages
     */
    public function setFlag($flag)
    {
        $this->flag = $flag;

        return $this;
    }

    /**
     * Get flag
     *
     * @return string 
     */
    public function getFlag()
    {
        return $this->flag;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Languages
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set abbreviation1
     *
     * @param string $abbreviation1
     * @return Languages
     */
    public function setAbbreviation1($abbreviation1)
    {
        $this->abbreviation1 = $abbreviation1;

        return $this;
    }

    /**
     * Get abbreviation1
     *
     * @return string 
     */
    public function getAbbreviation1()
    {
        return $this->abbreviation1;
    }

    /**
     * Set abbreviation2
     *
     * @param string $abbreviation2
     * @return Languages
     */
    public function setAbbreviation2($abbreviation2)
    {
        $this->abbreviation2 = $abbreviation2;

        return $this;
    }

    /**
     * Get abbreviation2
     *
     * @return string 
     */
    public function getAbbreviation2()
    {
        return $this->abbreviation2;
    }

    /**
     * Set abbreviation3
     *
     * @param string $abbreviation3
     * @return Languages
     */
    public function setAbbreviation3($abbreviation3)
    {
        $this->abbreviation3 = $abbreviation3;

        return $this;
    }

    /**
     * Get abbreviation3
     *
     * @return string 
     */
    public function getAbbreviation3()
    {
        return $this->abbreviation3;
    }

    /**
     * Set isdefault
     *
     * @param boolean $isdefault
     * @return Languages
     */
    public function setIsdefault($isdefault)
    {
        $this->isdefault = $isdefault;

        return $this;
    }

    /**
     * Get isdefault
     *
     * @return boolean 
     */
    public function getIsdefault()
    {
        return $this->isdefault;
    }

    /**
     * Set isdefaultBackend
     *
     * @param boolean $isdefaultBackend
     * @return Languages
     */
    public function setIsdefaultBackend($isdefaultBackend)
    {
        $this->isdefaultBackend = $isdefaultBackend;

        return $this;
    }

    /**
     * Get isdefaultBackend
     *
     * @return boolean 
     */
    public function getIsdefaultBackend()
    {
        return $this->isdefaultBackend;
    }

    /**
     * Set encoding
     *
     * @param string $encoding
     * @return Languages
     */
    public function setEncoding($encoding)
    {
        $this->encoding = $encoding;

        return $this;
    }

    /**
     * Get encoding
     *
     * @return string 
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set active
     *
     * @param integer $active
     * @return Languages
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return integer 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set channel
     *
     * @param \Application\Entity\Channels $channel
     * @return Languages
     */
    public function setChannel(\Application\Entity\Channels $channel = null)
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get channel
     *
     * @return \Application\Entity\Channels 
     */
    public function getChannel()
    {
        return $this->channel;
    }
}
