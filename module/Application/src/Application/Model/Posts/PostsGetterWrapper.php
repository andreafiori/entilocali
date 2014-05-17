<?php

namespace Application\Model\Posts;

use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapper
{
    private $postsGetter;
    
    private $input;
    
    /**
     * @param \Application\Model\Posts\PostsGetter $postsGetter
     */
    public function __construct(PostsGetter $postsGetter)
    {
        $this->postsGetter = $postsGetter;
    }
    
    public function setPostsGetterQueryBuilder()
    {
        $language   = $this->getInput('language', 1);
        $channel    = $this->getInput('channel', 1);
        
        $this->postsGetter->setMainQuery();
        
        $this->postsGetter->setChannelId($channel ? $channel : 1);
        $this->postsGetter->setLanguageId($language ? $language : 1);
        $this->postsGetter->setId( $this->getInput('id', 1) );
        $this->postsGetter->setNomeCategoria( $this->getInput('category', 1) );
        $this->postsGetter->setTitolo( $this->getInput('title', 1) );
        $this->postsGetter->setTipo( $this->getInput('tipo', 1) );
        $this->postsGetter->setOrderBy( $this->getInput('orderby', 1) );
        $this->postsGetter->setStato( $this->getInput('stato', 1) );
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
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = $input;
        
        return $this->input;
    }
    
    /**
     * 
     * @param string $key
     * @param 0 or 1 or array
     * @return types
     */
    public function getInput($key = null, $noArray = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if (!$noArray) {
            return $this->input;
        }
    }
    
    /**
     * @return PostsGetter
     */
    public function getPostsGetter()
    {
        return $this->postsGetter;
    }
}
