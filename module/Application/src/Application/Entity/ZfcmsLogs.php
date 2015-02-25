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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="bigint", nullable=false)
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=false)
     */
    private $datetime = '2015-01-01 01:00:00';

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", length=65535, nullable=false)
     */
    private $message;

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
     * @var \Application\Entity\ZfcmsModules
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsModules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    private $module;



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
     * Set userId
     *
     * @param integer $userId
     * @return ZfcmsLogs
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    
        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
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
}
