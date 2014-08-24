<?php

namespace Admin\Model\Modules;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  21 August 2014
 */
class ModulesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\Categories\CategorieGetter **/
    protected $objectGetter;
 
    /**
     * @param \Admin\Model\Modules\ModulesGetter $modulesGetter
     */
    public function __construct(ModulesGetter $modulesGetter)
    {
        $this->setObjectGetter($modulesGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId($this->getInput('id',1));
        $this->objectGetter->setModuleId($this->getInput('moduleId',1));
        $this->objectGetter->setStatus($this->getInput('status',1));
        $this->objectGetter->setOrderBy($this->getInput('orderby',1), 'co.position');
        $this->objectGetter->setLimit($this->getInput('limit',1));
    }
}
