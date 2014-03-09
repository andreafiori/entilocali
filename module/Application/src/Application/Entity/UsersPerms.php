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
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=50, nullable=false)
     */
    private $value = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="role_id", type="bigint", nullable=false)
     */
    private $roleId;

    /**
     * @var integer
     *
     * @ORM\Column(name="perms_id", type="bigint", nullable=false)
     */
    private $permsId;



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
     * Set value
     *
     * @param string $value
     * @return UsersPerms
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set roleId
     *
     * @param integer $roleId
     * @return UsersPerms
     */
    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId()
    {
        return $this->roleId;
    }

    /**
     * Set permsId
     *
     * @param integer $permsId
     * @return UsersPerms
     */
    public function setPermsId($permsId)
    {
        $this->permsId = $permsId;

        return $this;
    }

    /**
     * Get permsId
     *
     * @return integer 
     */
    public function getPermsId()
    {
        return $this->permsId;
    }
}
