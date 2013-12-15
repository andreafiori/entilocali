<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersApikeys
 *
 * @ORM\Table(name="users_apikeys", uniqueConstraints={@ORM\UniqueConstraint(name="uniqueKeys", columns={"keystring", "keystring_secret", "rifuserid"})})
 * @ORM\Entity
 */
class UsersApikeys
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
     * @ORM\Column(name="keystring", type="string", length=80, nullable=true)
     */
    private $keystring;

    /**
     * @var string
     *
     * @ORM\Column(name="keystring_secret", type="string", length=80, nullable=true)
     */
    private $keystringSecret;

    /**
     * @var string
     *
     * @ORM\Column(name="rifuserid", type="string", length=80, nullable=true)
     */
    private $rifuserid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdate", type="datetime", nullable=true)
     */
    private $createdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="lastupdate", type="datetime", nullable=true)
     */
    private $lastupdate;



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
     * Set keystring
     *
     * @param string $keystring
     * @return UsersApikeys
     */
    public function setKeystring($keystring)
    {
        $this->keystring = $keystring;

        return $this;
    }

    /**
     * Get keystring
     *
     * @return string 
     */
    public function getKeystring()
    {
        return $this->keystring;
    }

    /**
     * Set keystringSecret
     *
     * @param string $keystringSecret
     * @return UsersApikeys
     */
    public function setKeystringSecret($keystringSecret)
    {
        $this->keystringSecret = $keystringSecret;

        return $this;
    }

    /**
     * Get keystringSecret
     *
     * @return string 
     */
    public function getKeystringSecret()
    {
        return $this->keystringSecret;
    }

    /**
     * Set rifuserid
     *
     * @param string $rifuserid
     * @return UsersApikeys
     */
    public function setRifuserid($rifuserid)
    {
        $this->rifuserid = $rifuserid;

        return $this;
    }

    /**
     * Get rifuserid
     *
     * @return string 
     */
    public function getRifuserid()
    {
        return $this->rifuserid;
    }

    /**
     * Set createdate
     *
     * @param \DateTime $createdate
     * @return UsersApikeys
     */
    public function setCreatedate($createdate)
    {
        $this->createdate = $createdate;

        return $this;
    }

    /**
     * Get createdate
     *
     * @return \DateTime 
     */
    public function getCreatedate()
    {
        return $this->createdate;
    }

    /**
     * Set lastupdate
     *
     * @param \DateTime $lastupdate
     * @return UsersApikeys
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
