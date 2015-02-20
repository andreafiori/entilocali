<?php

namespace Admin\Model\Posts;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
class CategoriesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var CategoriesGetter 
     */
    protected $objectGetter;
    
    /**
     * @param CategoriesGetter $objectGetter
     */
    public function __construct(CategoriesGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId($this->getInput('id',1));
        $this->objectGetter->setModuleId($this->getInput('moduleId',1));
        $this->objectGetter->setStatus($this->getInput('status',1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1), 'co.position');
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1), 'co.position');
        $this->objectGetter->setLimit($this->getInput('limit', 1));
    }
}
