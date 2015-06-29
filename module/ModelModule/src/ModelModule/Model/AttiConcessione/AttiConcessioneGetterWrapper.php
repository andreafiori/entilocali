<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\RecordsGetterWrapperAbstract;

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
        $this->objectGetter->setAttivo( $this->getInput('attivo', 1) );
        $this->objectGetter->setImporto( $this->getInput('importo', 1) );
        $this->objectGetter->setBeneficiarioSearch( $this->getInput('beneficiarioSearch', 1) );
        $this->objectGetter->setFreeSearch( $this->getInput('freeSearch', 1) );
        $this->objectGetter->setProgressivo( $this->getInput('progressivo', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setGroupBy( $this->getInput('groupBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );

        return null;
    }
}