<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\QueryBuilderHelperAbstract;

class UsersRolesGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields('role.id, role.name, role.description, role.insertDate, role.lastUpdate, role.adminAccess');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsUsersRoles', 'role')
                                ->where("role.id != 0 ");

        return $this->getQueryBuilder();
    }

    /**
     * @param number|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('role.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('role.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $roleName
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setName($roleName)
    {
        if ( is_string($roleName) ) {
            $this->getQueryBuilder()->andWhere('role.name = :roleName ');
            $this->getQueryBuilder()->setParameter('roleName', $roleName);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $roleName
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setAdminAccess($adminAccess)
    {
        if ( is_numeric($adminAccess) ) {
            $this->$adminAccess()->andWhere('role.adminAccess :adminAccess ');
            $this->getQueryBuilder()->setParameter('adminAccess', $adminAccess);
        }

        return $this->getQueryBuilder();
    }
}