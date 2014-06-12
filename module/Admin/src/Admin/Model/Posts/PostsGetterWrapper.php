<?php

namespace Admin\Model\Posts;

use Admin\Model\Posts\PostsGetter;
use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $postsGetter;

    /**
     * @param \Application\Model\Posts\PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->postsGetter = $postsGetter;
    }
    
    /**
     * set PostsGetter query options
     */
    public function setupQueryBuilder()
    {
        $language   = $this->getInput('language', 1);
        $channel    = $this->getInput('channel', 1);
        
        $this->postsGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->postsGetter->setMainQuery();
 
        $this->postsGetter->setChannelId($channel ? $channel : 1);
        $this->postsGetter->setLanguageId($language ? $language : 1);
        $this->postsGetter->setId( $this->getInput('id', 1) );
        $this->postsGetter->setCategoryName( $this->getInput('category', 1) );
        $this->postsGetter->setTitle( $this->getInput('title', 1) );
        $this->postsGetter->setType( $this->getInput('tipo', 1) );
        $this->postsGetter->setStatus( $this->getInput('stato', 1) );
        $this->postsGetter->setOrderBy( $this->getInput('orderby', 1) );
        $this->postsGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * Use the postsGetter class to select records
     * 
     * @return array
     */
    public function getRecords()
    {
        return $this->postsGetter->getQueryResult();
    }
    
    /**
     * @return \Application\Model\Posts\PostsGetter
     */
    public function getPostsGetter()
    {
        return $this->postsGetter;
    }
}
