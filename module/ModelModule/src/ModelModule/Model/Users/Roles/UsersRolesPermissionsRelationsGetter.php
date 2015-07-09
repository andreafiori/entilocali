<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsRelationsGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('permission.id AS permissionId, role.id AS roleId, role.name AS roleName,
                                    permission.flag, permission.description
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
            ->from('Application\Entity\ZfcmsUsersRolesPermissionsRelations', 'permrel')
            ->join('permrel.role', 'role')
            ->join('permrel.permission', 'permission')
            ->where("permrel.role = role.id AND permrel.permission = permission.id ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setRoleId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('permrel.role = :roleId ');
            $this->getQueryBuilder()->setParameter('roleId', $id);
        }

        return $this->getQueryBuilder();
    }
}
