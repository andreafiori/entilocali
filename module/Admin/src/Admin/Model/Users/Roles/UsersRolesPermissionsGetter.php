<?php

namespace Admin\Model\Users\Roles;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('permission.id AS permissionId,
                                    permission.flag, permission.description,
                                    permission.group
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsUsersRolesPermissions', 'permission')
                                ->where("permission.id != 0 ");

        return $this->getQueryBuilder();
    }
}
