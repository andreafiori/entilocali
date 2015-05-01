<?php

namespace Admin\Model\StatoCivile;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var StatoCivileGetter
     */
    protected $objectGetter;

    /**
     * @param StatoCivileGetter $statoCivileGetter
     */
    public function __construct(StatoCivileGetter $statoCivileGetter)
    {
        $this->setObjectGetter($statoCivileGetter);
    }

    public function setupQueryBuilder()
    { 
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setProgressivo( $this->getInput('progressivo', 1) );
        $this->objectGetter->setAnno( $this->getInput('anno', 1) );
        $this->objectGetter->setTextSearch( $this->getInput('textSearch', 1) );
        $this->objectGetter->setSezioneId( $this->getInput('textSearch', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}