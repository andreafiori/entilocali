<?php

namespace Admin\Model\Categories;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
 class CategoriesGetterWrapper extends RecordsGetterWrapperAbstract
 {
    private $categoriesGetter;
 
    /**
     * @param \Admin\Model\Categories\CategorieGetter $categoriesGetter
     */
    public function __construct(CategoriesGetter $categoriesGetter)
    {
        $this->categoriesGetter = $categoriesGetter;
    }
    
    public function setupQueryBuilder()
    {
        $this->categoriesGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->categoriesGetter->setMainQuery();
        
        $this->categoriesGetter->setId($this->getInput('id',1));
        $this->categoriesGetter->setModuleId($this->getInput('moduleId',1));
        $this->categoriesGetter->setStatus($this->getInput('status',1));
        $this->categoriesGetter->setOrderBy($this->getInput('orderby',1), 'co.position');
        $this->categoriesGetter->setLimit($this->getInput('limit',1));
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->categoriesGetter->getQueryResult(); 
    }
}
