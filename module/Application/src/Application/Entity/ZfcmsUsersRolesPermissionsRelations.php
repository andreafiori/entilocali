<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ZfcmsUsersRolesPermissionsRelations
 *
 * @ORM\Table(name="zfcms_users_roles_permissions_relations", indexes={@ORM\Index(name="fk_users_role_id", columns={"role_id"}), @ORM\Index(name="fk_users_roles_permissions_id", columns={"permission_id"})})
 * @ORM\Entity
 */
class ZfcmsUsersRolesPermissionsRelations
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
     * @var \Application\Entity\ZfcmsUsersRolesPermissions
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsersRolesPermissions")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     * })
     */
    private $permission;

    /**
     * @var \Application\Entity\ZfcmsUsersRoles
     *
     * @ORM\ManyToOne(targetEntity="Application\Entity\ZfcmsUsersRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $role;



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
     * Set permission
     *
     * @param \Application\Entity\ZfcmsUsersRolesPermissions $permission
     * @return ZfcmsUsersRolesPermissionsRelations
     */
    public function setPermission(\Application\Entity\ZfcmsUsersRolesPermissions $permission = null)
    {
        $this->permission = $permission;
    
        return $this;
    }

    /**
     * Get permission
     *
     * @return \Application\Entity\ZfcmsUsersRolesPermissions 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set role
     *
     * @param \Application\Entity\ZfcmsUsersRoles $role
     * @return ZfcmsUsersRolesPermissionsRelations
     */
    public function setRole(\Application\Entity\ZfcmsUsersRoles $role = null)
    {
        $this->role = $role;
    
        return $this;
    }

    /**
     * Get role
     *
     * @return \Application\Entity\ZfcmsUsersRoles 
     */
    public function getRole()
    {
        return $this->role;
    }
}
