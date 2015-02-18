<?php

namespace Admin\Model\AttiConcessione;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  15 December 2014
 */
class AttiConcessioneRespProcGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AttiConcessioneRespProcGetter
     */
    protected $objectGetter;

    /**
     * @param AttiConcessioneRespProcGetter $objectGetter
     */
    public function __construct(AttiConcessioneRespProcGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}