<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersPerms
 *
 * @ORM\Table(name="users_perms")
 * @ORM\Entity
 */
class UsersPerms
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
     * @ORM\Column(name="rifroleperm", type="integer", nullable=false)
     */
    private $rifroleperm;

    /**
     * @var integer
     *
     * @ORM\Column(name="rifpermnameid", type="integer", nullable=false)
     */
    private $rifpermnameid;

    /**
     * @var string
     *
     * @ORM\Column(name="valueperm", type="string", length=50, nullable=false)
     */
    private $valueperm = '0';



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
     * Set rifroleperm
     *
     * @param integer $rifroleperm
     * @return UsersPerms
     */
    public function setRifroleperm($rifroleperm)
    {
        $this->rifroleperm = $rifroleperm;

        return $this;
    }

    /**
     * Get rifroleperm
     *
     * @return integer 
     */
    public function getRifroleperm()
    {
        return $this->rifroleperm;
    }

    /**
     * Set rifpermnameid
     *
     * @param integer $rifpermnameid
     * @return UsersPerms
     */
    public function setRifpermnameid($rifpermnameid)
    {
        $this->rifpermnameid = $rifpermnameid;

        return $this;
    }

    /**
     * Get rifpermnameid
     *
     * @return integer 
     */
    public function getRifpermnameid()
    {
        return $this->rifpermnameid;
    }

    /**
     * Set valueperm
     *
     * @param string $valueperm
     * @return UsersPerms
     */
    public function setValueperm($valueperm)
    {
        $this->valueperm = $valueperm;

        return $this;
    }

    /**
     * Get valueperm
     *
     * @return string 
     */
    public function getValueperm()
    {
        return $this->valueperm;
    }
}
