<?php

namespace Admin\Model\AttiConcessione;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AttiConcessioneGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var AttiConcessioneGetter
     */
    protected $objectGetter;
    
    /**
     * @param AttiConcessioneGetter $objectGetter
     */
    public function __construct(AttiConcessioneGetter $objectGetter)
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
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}