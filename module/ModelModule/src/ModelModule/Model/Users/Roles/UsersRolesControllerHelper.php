<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;
use Zend\InputFilter\InputFilterAwareInterface;

class UsersRolesControllerHelper extends ControllerHelperAbstract
{
    /**
     * @param InputFilterAwareInterface $formData
     *
     * @return int
     */
    public function insert(InputFilterAwareInterface $formData)
    {
        $this->assertConnection();

        return $this->getConnection()->insert(
            DbTableContainer::usersRoles,
            array(
                'name'          => $formData->name,
                'description'   => $formData->description,
                'admin_access'  => $formData->adminAccess,
                'status'        => 1,
                'insert_date'   => date("Y-m-d H:i:s"),
                'last_update'   => date("Y-m-d H:i:s"),
            )
        );
    }

    /**
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

    public function delete()
    {

    }

    public function insertPermissionRelation($roleId, $permissionId)
    {

    }

    public function deletePermissionRelation($roleId, $permissionId)
    {

    }
}
