<?php

namespace ModelModule\Model\Users\Roles;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class UsersRolesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersRolesGetter
     */
    protected $objectGetter;

    /**
     * @param UsersRolesGetter $objectGetter
     */
    public function __construct(UsersRolesGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    /**
     * @return null
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();

        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setName( $this->getInput('name', 1) );
        $this->objectGetter->setAdminAccess( $this->getInput('adminAccess', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}
