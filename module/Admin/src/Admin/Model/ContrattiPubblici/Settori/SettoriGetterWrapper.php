<?php

namespace Admin\Model\ContrattiPubblici\Settori;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SettoriGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var SettoriGetter
     */
    protected $objectGetter;
    
    /**
     * @param SettoriGetter $settoriGetter
     */
    public function __construct(SettoriGetter $objectGetter)
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