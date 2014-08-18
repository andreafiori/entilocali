<?php

namespace Admin\Model\ContrattiPubblici;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class SettoriGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var  \Admin\Model\ContrattiPubblici\SettoriGetter **/
    protected $objectGetter;
    
    /**
     * @param \Admin\Model\ContrattiPubblici\SettoriGetter $settoriGetter
     */
    public function __construct(SettoriGetter $settoriGetter)
    {
        $this->setObjectGetter($settoriGetter);
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