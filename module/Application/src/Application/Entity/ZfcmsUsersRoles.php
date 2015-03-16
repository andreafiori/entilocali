<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersRoles
 *
 * @ORM\Table(name="zfcms_users_roles")
 * @ORM\Entity
 */
class ZfcmsUsersRoles
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
     * @ORM\Column(name="code", type="string", length=80, nullable=false)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_date", type="datetime", nullable=false)
     */
    private $insertDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false)
     */
    private $lastUpdate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=15, nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="admin_access", type="integer", nullable=false)
     */
    private $adminAccess;



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
     * Set code
     *
     * @param string $code
     * @return ZfcmsUsersRoles
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ZfcmsUsersRoles
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
     * Set description
     *
     * @param string $description
     * @return ZfcmsUsersRoles
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
     * Set insertDate
     *
     * @param \DateTime $insertDate
     * @return ZfcmsUsersRoles
     */
    public function setInsertDate($insertDate)
    {
        $this->insertDate = $insertDate;
    
        return $this;
    }

    /**
     * Get insertDate
     *
     * @return \DateTime 
     */
    public function getInsertDate()
    {
        return $this->insertDate;
    }

    /**
     * Set lastUpdate
     *
     * @param \DateTime $lastUpdate
     * @return ZfcmsUsersRoles
     */
    public function setLastUpdate($lastUpdate)
    {
        $this->lastUpdate = $lastUpdate;
    
        return $this;
    }

    /**
     * Get lastUpdate
     *
     * @return \DateTime 
     */
    public function getLastUpdate()
    {
        return $this->lastUpdate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return ZfcmsUsersRoles
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
     * Set adminAccess
     *
     * @param integer $adminAccess
     * @return ZfcmsUsersRoles
     */
    public function setAdminAccess($adminAccess)
    {
        $this->adminAccess = $adminAccess;
    
        return $this;
    }

    /**
     * Get adminAccess
     *
     * @return integer 
     */
    public function getAdminAccess()
    {
        return $this->adminAccess;
    }
}
