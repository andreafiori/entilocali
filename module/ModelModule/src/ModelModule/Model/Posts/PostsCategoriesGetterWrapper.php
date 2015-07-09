<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\RecordsGetterWrapperAbstract;

class PostsCategoriesGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var PostsCategoriesGetter
     */
    protected $objectGetter;
    
    /**
     * @param PostsCategoriesGetter $objectGetter
     */
    public function __construct(PostsCategoriesGetter $objectGetter)
    {
        $this->setObjectGetter($objectGetter);
    }
    
    public function setupQueryBuilder()
    {
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId($this->getInput('id',1));
        $this->objectGetter->setModuleId($this->getInput('moduleId',1));
        $this->objectGetter->setChannelId($this->getInput('channelId',1));
        $this->objectGetter->setModuleCode($this->getInput('moduleCode',1));
        $this->objectGetter->setStatus($this->getInput('status',1));
        $this->objectGetter->setLanguageAbbreviation($this->getInput('languageAbbreviation',1));
        $this->objectGetter->setOrderBy($this->getInput('orderBy', 1), 'category.position');
        $this->objectGetter->setGroupBy($this->getInput('groupBy', 1));
        $this->objectGetter->setLimit($this->getInput('limit', 1));

        return null;
    }
}
