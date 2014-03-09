<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersApirequests
 *
 * @ORM\Table(name="users_apirequests")
 * @ORM\Entity
 */
class UsersApirequests
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
     * @ORM\Column(name="urlrequest", type="string", length=100, nullable=true)
     */
    private $urlrequest;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime", nullable=true)
     */
    private $datetime;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifiduser", type="bigint", nullable=true)
     */
    private $rifiduser;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifidapikey", type="bigint", nullable=true)
     */
    private $rifidapikey;



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
     * Set urlrequest
     *
     * @param string $urlrequest
     * @return UsersApirequests
     */
    public function setUrlrequest($urlrequest)
    {
        $this->urlrequest = $urlrequest;

        return $this;
    }

    /**
     * Get urlrequest
     *
     * @return string 
     */
    public function getUrlrequest()
    {
        return $this->urlrequest;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     * @return UsersApirequests
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
     * Set rifiduser
     *
     * @param integer $rifiduser
     * @return UsersApirequests
     */
    public function setRifiduser($rifiduser)
    {
        $this->rifiduser = $rifiduser;

        return $this;
    }

    /**
     * Get rifiduser
     *
     * @return integer 
     */
    public function getRifiduser()
    {
        return $this->rifiduser;
    }

    /**
     * Set rifidapikey
     *
     * @param integer $rifidapikey
     * @return UsersApirequests
     */
    public function setRifidapikey($rifidapikey)
    {
        $this->rifidapikey = $rifidapikey;

        return $this;
    }

    /**
     * Get rifidapikey
     *
     * @return integer 
     */
    public function getRifidapikey()
    {
        return $this->rifidapikey;
    }
}
