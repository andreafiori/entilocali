<?php

namespace ModelModule\Model\Log;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class LogGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var LogGetter
     */
    protected $objectGetter;

    /**
     * @param LogGetter $objectGetter
     */
    public function __construct(LogGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setUserId( $this->getInput('userId', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}