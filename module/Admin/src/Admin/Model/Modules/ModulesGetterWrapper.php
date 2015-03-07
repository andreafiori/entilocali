<?php

namespace Admin\Model\Modules;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  21 August 2014
 */
class ModulesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var ModulesGetter
     */
    protected $objectGetter;
 
    /**
     * @param ModulesGetter $objectGetter
     */
    public function __construct(ModulesGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }

    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId($this->getInput('id', 1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy',1));
        $this->objectGetter->setGroupBy($this->getInput('grouoBy',1));
        $this->objectGetter->setLimit($this->getInput('limit',1));
    }
}
