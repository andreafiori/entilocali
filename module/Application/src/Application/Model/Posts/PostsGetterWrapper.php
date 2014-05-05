<?php

namespace Application\Model\Posts;

use Application\Model\Posts\PostsGetter;

/**
 * Wrapper around PostsGetter
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapper
{
    private $postsGetter;
    
    private $input;
    
    public function __construct(PostsGetter $postsGetter)
    {
        $this->postsGetter = $postsGetter;
    }
    
    /**
     * Use the postsGetter class to select records
     * 
     * @return array
     */
    public function getRecords()
    {
        $this->postsGetter->setMainQuery();
        $this->postsGetter->setChannelId( $this->getInput('channel') );
        $this->postsGetter->setLanguageId( $this->getInput('language') );
        $this->postsGetter->setId( $this->getInput('id') );
        $this->postsGetter->setNomeCategoria( $this->getInput('nome_categoria') );
        $this->postsGetter->setTitolo( $this->getInput('titolo') );
        $this->postsGetter->setTipo( $this->getInput('tipo') );

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
     * @param 0 or 1 $noArray
     * @return types
     */
    public function getInput($key = null, $noArray = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if ( !$noArray ) {
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
