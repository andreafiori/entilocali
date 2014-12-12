<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class OperatoriGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var \Admin\Model\ContrattiPubblici\OperatoriGetter 
     */
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\ContrattiPubblici\ResposabiliProcedimentoGetter $operatoriGetter
     */
    public function __construct(OperatoriGetter $operatoriGetter)
    {
        $this->setObjectGetter($operatoriGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
}