<?php

namespace Admin\Model\Entiterzi;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  17 August 2014
 */
class EntiTerziGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\Entiterzi\EntiTerziGetter **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\Entiterzi\EntiTerziGetter $entiTerziGetter
     */
    public function __construct(EntiTerziGetter $entiTerziGetter)
    {
        $this->setObjectGetter($entiTerziGetter);
    }
    
    /**
     * setup and execute query
     */
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();        
        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
