<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UsersRolesPerms
 *
 * @ORM\Table(name="users_roles_perms")
 * @ORM\Entity
 */
class UsersRolesPerms
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
     * @ORM\Column(name="roleperm_id", type="integer", nullable=false)
     */
    private $rolepermId;

    /**
     * @var integer
     *
     * @ORM\Column(name="permission_id", type="integer", nullable=false)
     */
    private $permissionId;



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
     * Set rolepermId
     *
     * @param integer $rolepermId
     * @return UsersRolesPerms
     */
    public function setRolepermId($rolepermId)
    {
        $this->rolepermId = $rolepermId;

        return $this;
    }

    /**
     * Get rolepermId
     *
     * @return integer 
     */
    public function getRolepermId()
    {
        return $this->rolepermId;
    }

    /**
     * Set permissionId
     *
     * @param integer $permissionId
     * @return UsersRolesPerms
     */
    public function setPermissionId($permissionId)
    {
        $this->permissionId = $permissionId;

        return $this;
    }

    /**
     * Get permissionId
     *
     * @return integer 
     */
    public function getPermissionId()
    {
        return $this->permissionId;
    }
}
