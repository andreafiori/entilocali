<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\FormData\CrudHandlerAbstract;

/**
 * @author Andrea Fiori
 * @since  13 March 2015
 */
class UsersRolesPermissionsCrudHandler extends CrudHandlerAbstract
{
    private $rolesTable = 'zfcms_users_roles';

    private $rolesPermissionsRelationsTable = 'zfcms_users_roles_permissions_relations';

    public function insert()
    {
        $this->getConnection()->beginTransaction();
        try {
            // Insert Role (admin_access if it's a backend user)

            // Insert Permissions (if it's a backend user)

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }

    public function update()
    {
        $this->getConnection()->beginTransaction();
        try {

            $this->getConnection()->update(
                $this->rolesTable,
                array(
                    'code'          => str_replace(" ", '', $this->rawPost['name']),
                    'name'          => $this->rawPost['name'],
                    'description'   => $this->rawPost['description'],
                    'admin_access'  => $this->rawPost['adminAccess'],
                    'last_update'   => date("Y-m-d H:i:s")
                ),
                array(
                    'id' => $this->rawPost['id']
                )
            );

            // Delete all permissions relations
            $this->getConnection()->delete($this->rolesPermissionsRelationsTable, array(
                'role_id' => $this->rawPost['id']
            ));

            // Add new permissions
            if (isset($this->rawPost['permissions'])) {
                foreach($this->rawPost['permissions'] as $key => $value) {
                    $this->getConnection()->insert($this->rolesPermissionsRelationsTable, array(
                        'role_id'       => $this->rawPost['id'],
                        'permission_id' => $value,
                    ));
                }
            }

            $this->getConnection()->commit();

        } catch (\Exception $e) {
            $this->getConnection()->rollBack();
            return $this->setErrorMessage($e->getMessage());
        }
    }
}