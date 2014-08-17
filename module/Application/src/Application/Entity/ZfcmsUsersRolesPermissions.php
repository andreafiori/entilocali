<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersRolesPermissions
 *
 * @ORM\Table(name="zfcms_users_roles_permissions", indexes={@ORM\Index(name="ruolo_permesso_id", columns={"role_permission_id"}), @ORM\Index(name="permesso_id", columns={"permission_id"})})
 * @ORM\Entity
 */
class ZfcmsUsersRolesPermissions
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
     * @ORM\Column(name="role_permission_id", type="bigint", nullable=false)
     */
    private $rolePermissionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="permission_id", type="bigint", nullable=false)
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
     * Set rolePermissionId
     *
     * @param integer $rolePermissionId
     * @return ZfcmsUsersRolesPermissions
     */
    public function setRolePermissionId($rolePermissionId)
    {
        $this->rolePermissionId = $rolePermissionId;
    
        return $this;
    }

    /**
     * Get rolePermissionId
     *
     * @return integer 
     */
    public function getRolePermissionId()
    {
        return $this->rolePermissionId;
    }

    /**
     * Set permissionId
     *
     * @param integer $permissionId
     * @return ZfcmsUsersRolesPermissions
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
