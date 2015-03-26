<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersTodo
 *
 * @ORM\Table(name="zfcms_users_todo")
 * @ORM\Entity
 */
class ZfcmsUsersTodo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtodo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtodo;

    /**
     * @var string
     *
     * @ORM\Column(name="taskname", type="string", length=50, nullable=true)
     */
    private $taskname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifuser", type="integer", nullable=true)
     */
    private $rifuser;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="timelapsed", type="string", length=50, nullable=true)
     */
    private $timelapsed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiredate", type="datetime", nullable=true)
     */
    private $expiredate;



    /**
     * Get idtodo
     *
     * @return integer 
     */
    public function getIdtodo()
    {
        return $this->idtodo;
    }

    /**
     * Set taskname
     *
     * @param string $taskname
     * @return ZfcmsUsersTodo
     */
    public function setTaskname($taskname)
    {
        $this->taskname = $taskname;
    
        return $this;
    }

    /**
     * Get taskname
     *
     * @return string 
     */
    public function getTaskname()
    {
        return $this->taskname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return ZfcmsUsersTodo
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
     * Set rifuser
     *
     * @param integer $rifuser
     * @return ZfcmsUsersTodo
     */
    public function setRifuser($rifuser)
    {
        $this->rifuser = $rifuser;
    
        return $this;
    }

    /**
     * Get rifuser
     *
     * @return integer 
     */
    public function getRifuser()
    {
        return $this->rifuser;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return ZfcmsUsersTodo
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set timelapsed
     *
     * @param string $timelapsed
     * @return ZfcmsUsersTodo
     */
    public function setTimelapsed($timelapsed)
    {
        $this->timelapsed = $timelapsed;
    
        return $this;
    }

    /**
     * Get timelapsed
     *
     * @return string 
     */
    public function getTimelapsed()
    {
        return $this->timelapsed;
    }

    /**
     * Set expiredate
     *
     * @param \DateTime $expiredate
     * @return ZfcmsUsersTodo
     */
    public function setExpiredate($expiredate)
    {
        $this->expiredate = $expiredate;
    
        return $this;
    }

    /**
     * Get expiredate
     *
     * @return \DateTime 
     */
    public function getExpiredate()
    {
        return $this->expiredate;
    }
}
