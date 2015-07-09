<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use Zend\InputFilter\InputFilterAwareInterface;

class UsersRolesControllerHelper extends ControllerHelperAbstract
{
    /**
     * Insert a new user role
     *
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::usersRoles,
            array(
                'code'          => str_replace(' ', '', $formData->name),
                'name'          => $formData->name,
                'description'   => $formData->description,
                'admin_access'  => $formData->adminAccess,
                'status'        => 1,
                'insert_date'   => date("Y-m-d H:i:s"),
                'last_update'   => date("Y-m-d H:i:s"),
            )
        );

        return $this->getConnection()->lastInsertId();
    }

    /**
     * Update role record
     *
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function update(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::usersRoles,
            array(
                'name'          => $formData->name,
                'description'   => $formData->description,
                'admin_access'  => $formData->adminAccess,
                'last_update'   => date("Y-m-d H:i:s"),
            ),
            array('id' => $formData->id),
            array('limit' => 1)
        );
    }

    /**
     * Delete permission relation on database
     *
     * @param int $roleId
     *
     * @return bool
     */
    public function deleteRolePermissions($roleId)
    {
        $this->assertConnection();

        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=0');
        $this->getConnection()->delete(
            DbTableContainer::usersRolesPermissionsRelations,
            array('role_id' => $roleId)
        );
        $this->getConnection()->query('SET FOREIGN_KEY_CHECKS=1');

        return true;
    }

    /**
     * Insert permission relation on database
     *
     * @param int $roleId
     * @param int $permissionId
     *
     * @return int
     */
    public function insertPermissionRelation($roleId, $permissionId)
    {
        $this->assertConnection();

        $this->getConnection()->insert(
            DbTableContainer::usersRolesPermissionsRelations,
            array(
                'role_id'       => $roleId,
                'permission_id' => $permissionId,
            )
        );

        return $this->getConnection()->lastInsertId();
    }
}
