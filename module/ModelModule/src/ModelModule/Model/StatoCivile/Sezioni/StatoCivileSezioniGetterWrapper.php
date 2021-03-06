<?php

namespace ModelModule\Model\StatoCivile\Sezioni;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class StatoCivileSezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var StatoCivileSezioniGetter
     */
    protected $objectGetter;

    /**
     * @param StatoCivileSezioniGetter $objectGetter
     */
    public function __construct(StatoCivileSezioniGetter $objectGetter)
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