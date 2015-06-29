<?php

namespace ModelModule\Model\Users;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class UsersGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var UsersGetter 
     */
    protected $objectGetter;

    /**
     * @param UsersGetter $objectGetter
     */
    public function __construct(UsersGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setSurname( $this->getInput('surname', 1) );
        $this->objectGetter->setEmail( $this->getInput('email', 1) );
        $this->objectGetter->setUsername( $this->getInput('username', 1) );
        $this->objectGetter->setPassword( $this->getInput('password', 1) );
        $this->objectGetter->setStatus( $this->getInput('status', 1) );
        $this->objectGetter->setRoleName( $this->getInput('roleName', 1) );
        $this->objectGetter->setEmailUsersname( $this->getInput('emailUsername', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}
