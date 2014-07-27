<?php

namespace Admin\Model\Users;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\Users\UsersSettoriGetter;

/**
 * @author Andrea Fiori
 * @since  26 July 2014
 */
class UsersSettoriGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\Users\UsersSettoriGetter **/
    protected $objectGetter;

    public function __construct(UsersSettoriGetter $usersSettoriGetter)
    {
        $this->setObjectGetter($usersSettoriGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->getObjectGetter()->getQueryResult();
    }
}
