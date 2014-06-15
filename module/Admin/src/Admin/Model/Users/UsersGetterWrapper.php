<?php

namespace Admin\Model\Users;

use Admin\Model\Users\UsersGetter;
use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 June 2014
 */
class UsersGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $usersGetter;

    /**
     * @param \Admin\Model\Users\UsersGetter $usersGetter
     */
    public function __construct(UsersGetter $usersGetter)
    {
        $this->usersGetter = $usersGetter;
    }
    
    public function setupQueryBuilder()
    {
        $this->usersGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->usersGetter->setMainQuery();
        
        $this->usersGetter->setId( $this->getInput('id', 1) );
        $this->usersGetter->setSurname( $this->getInput('surname', 1) );
        $this->usersGetter->setStatus( $this->getInput('status', 1) );
        //$this->usersGetter->setOrderBy( $this->getInput('orderby', 1) );
        $this->usersGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->usersGetter->getQueryResult();
    }
    
    /**
     * @return \Admin\Model\Users\UsersGetter
     */
    public function getPostsGetter()
    {
        return $this->usersGetter;
    }
}
