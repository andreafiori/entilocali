<?php

namespace Admin\Model\Posts;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapper extends RecordsGetterWrapperAbstract
{
    /**
     * @var PostsGetter
     */
    protected $objectGetter;

    /**
     * @param PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->setObjectGetter($postsGetter);
    }

    public function setupQueryBuilder()
    {
        $language   = $this->getInput('language', 1);
        $channel    = $this->getInput('channel', 1);
        
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setChannelId($channel ? $channel : 1);
        $this->objectGetter->setLanguageId($language ? $language : 1);
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setCategoryName( $this->getInput('category', 1) );
        $this->objectGetter->setTitle( $this->getInput('title', 1) );
        $this->objectGetter->setType( $this->getInput('type', 1) );
        $this->objectGetter->setStatus( $this->getInput('status', 1) );
        $this->objectGetter->setModuleCode( $this->getInput('moduleCode', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1), 'po.position' );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }

    public function addCategories(array $records)
    {

    }
}
