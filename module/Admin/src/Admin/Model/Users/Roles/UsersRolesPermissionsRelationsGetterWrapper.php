<?php

namespace Admin\Model\Users\Roles;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  10 March 2015
 */
class UsersRolesPermissionsRelationsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersRolesPermissionsRelationsGetter
     */
    protected $objectGetter;

    /**
     * @param UsersRolesPermissionsRelationsGetter $objectGetter
     */
    public function __construct(UsersRolesPermissionsRelationsGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setRoleId( $this->getInput('roleId', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}