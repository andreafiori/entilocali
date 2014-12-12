<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class ContrattiPubbliciGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var \Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter
     */
    protected $objectGetter;
    
    public function __construct(ContrattiPubbliciGetter $contrattiPubbliciGetter)
    {
        $this->setObjectGetter($contrattiPubbliciGetter);
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