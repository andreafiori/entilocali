<?php

namespace Admin\Model\AmministrazioneTrasparente;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  12 December 2014
 */
class AmministrazioneTrasparenteGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var \Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter
     */
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\AmministrazioneTrasparente\AmministrazioneTrasparenteGetter $amministrazioneTrasparenteGetter
     */
    public function __construct(AmministrazioneTrasparenteGetter $amministrazioneTrasparenteGetter)
    {
        $this->setObjectGetter($amministrazioneTrasparenteGetter);
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