<?php

namespace Application\Model\Posts;

use Application\Model\RouterManagers\RouterManagerInterface;
use Application\Model\RouterManagers\RouterManagerAbstract;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontend extends RouterManagerAbstract implements RouterManagerInterface
{
    protected $postsGetterWrapper;
    
    public function setPostsGetterWrapper(PostsGetterWrapper $postsGetterWrapper)
    {
        $this->postsGetterWrapper = $postsGetterWrapper;
    }
    
    /**
     * Generate main array record for the index frontend controller
     * 
     * @return array
     * @throws \Application\Model\NullException
     */
    public function setupRecord()
    {
        $frontendPostsInput = array(
            'title'     => $this->getInput('title', 1),
            'category'  => $this->getInput('category', 1),
        );
        
        if ( !$frontendPostsInput['title'] and !$frontendPostsInput['category'] ) {
            // TODO: redirect !?
            return false;
        }
        
        if (!$this->postsGetterWrapper) {
            $em = $this->getInput('entityManager');
            if ( $em instanceof \Doctrine\ORM\EntityManager ) {
                $this->setPostsGetterWrapper(new PostsGetterWrapper(new PostsGetter($em)) );
            } else {
                throw new \Application\Model\NullException('PostsGetterWrapper instance is not set. Check out the Entity Manager input');
            }
        }
        
        $this->postsGetterWrapper->setInput($frontendPostsInput);
        $this->postsGetterWrapper->setPostsGetterQueryBuilder();
        
        $this->setRecords( $this->postsGetterWrapper->getRecords() );
        
        $records = $this->getRecords();
        
        if ( isset($records[0]) ) {
            $this->setTemplate($records[0]['template']);
        }

        return $this->getOutput();
    }
}