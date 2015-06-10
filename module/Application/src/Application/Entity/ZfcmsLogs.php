<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsLogs
 *
 * @ORM\Table(name="zfcms_logs", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="fk_logs_module_id", columns={"module_id"})})
 * @ORM\Entity
 */
class ZfcmsLogs
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
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="backend", type="smallint", nullable=false)
     */
    private $backend;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference_id", type="bigint", nullable=false)
     */
    private $referenceId;

    /**
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;

    /**
     * @var \Application\Entity\ZfcmsUsers
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsers")
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
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return ZfcmsLogs
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;
    
        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime 
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return ZfcmsLogs
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
     * Set description
     *
     * @param string $description
     * @return ZfcmsLogs
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
     * Set type
     *
     * @param string $type
     * @return ZfcmsLogs
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set backend
     *
     * @param integer $backend
     * @return ZfcmsLogs
     */
    public function setBackend($backend)
    {
        $this->backend = $backend;
    
        return $this;
    }

    /**
     * Get backend
     *
     * @return integer 
     */
    public function getBackend()
    {
        return $this->backend;
    }

    /**
     * Set referenceId
     *
     * @param integer $referenceId
     * @return ZfcmsLogs
     */
    public function setReferenceId($referenceId)
    {
        $this->referenceId = $referenceId;
    
        return $this;
    }

    /**
     * Get referenceId
     *
     * @return integer 
     */
    public function getReferenceId()
    {
        return $this->referenceId;
    }

    /**
     * Set module
     *
     * @param \Application\Entity\ZfcmsModules $module
     * @return ZfcmsLogs
     */
    public function setModule(\Application\Entity\ZfcmsModules $module = null)
    {
        $this->module = $module;
    
        return $this;
    }

    /**
     * Get module
     *
     * @return \Application\Entity\ZfcmsModules 
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set user
     *
     * @param \Application\Entity\ZfcmsUsers $user
     * @return ZfcmsLogs
     */
    public function setUser(\Application\Entity\ZfcmsUsers $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Application\Entity\ZfcmsUsers 
     */
    public function getUser()
    {
        return $this->user;
    }
}
