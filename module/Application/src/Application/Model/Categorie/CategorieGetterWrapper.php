<?php

 namespace Application\Model\Categorie;
 
 use Application\Model\RecordsGetterWrapperAbstract;
 
/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
 class CategorieGetterWrapper extends RecordsGetterWrapperAbstract
 {
    private $categorieGetter;
 
    /**
     * @param \Application\Model\Categorie\CategorieGetter $categorieGetter
     */
    public function __construct(CategorieGetter $categorieGetter)
    {
        $this->categorieGetter = $categorieGetter;
    }
    
    public function getCategorieGetter()
    {
        return $this->categorieGetter;
    }
    
    public function setupQueryBuilder()
    {
        $this->categorieGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->categorieGetter->setMainQuery();
        
        $this->categorieGetter->setId($this->getInput('id',1));
        $this->categorieGetter->setModuloId($this->getInput('moduloId',1));
        $this->categorieGetter->setOrderBy($this->getInput('orderby',1));
        $this->categorieGetter->setLimit($this->getInput('limit',1));
    }
    
    public function getRecords()
    {
        return $this->categorieGetter->getQueryResult(); 
    }
}
