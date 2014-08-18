<?php

namespace Admin\Model\StatoCivile;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SezioniGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var  \Admin\Model\StatoCivile\SezioniGetter **/
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\StatoCivile\SezioniGetter $sezioniGetter
     */
    public function __construct(SezioniGetter $sezioniGetter)
    {
        $this->setObjectGetter($sezioniGetter);
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