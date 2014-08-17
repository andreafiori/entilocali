<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  14 August 2014
 */
class SceltaContraenteGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var  \Admin\Model\ContrattiPubblici\SceltaContraenteGetter **/
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\ContrattiPubblici\SceltaContraenteGetter $sceltaContraenteGetter
     */
    public function __construct(SceltaContraenteGetter $sceltaContraenteGetter)
    {
        $this->setObjectGetter($sceltaContraenteGetter);
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