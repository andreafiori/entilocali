<?php

namespace Admin\Model\Users;

use Application\Model\RecordsGetterAbstract;
use Admin\Model\Users\UsersGetter;
use Admin\Model\Users\UsersGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  31 July 2014
 */
class UsersRecordsGetter extends RecordsGetterAbstract
{
    /**
     * @param array $input
     */
    public function setUsers(array $input)
    {
        $usersGetterWrapper = new UsersGetterWrapper( new UsersGetter($this->getInput('entityManager',1)) );
        $usersGetterWrapper->setInput($input);
        $usersGetterWrapper->setupQueryBuilder();
        
        $this->setRecords( $usersGetterWrapper->getRecords() );
    }
}