<?php

namespace Application\Model\Posts;

use Application\Model\FrontendHelpers\FrontendRouterInterface;
use Application\Model\FrontendHelpers\FrontendRouterAbstract;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * Generate records for the frontend index controller
 * 
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontend extends FrontendRouterAbstract implements FrontendRouterInterface
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
     */
    public function setupFrontendRecord()
    {
        $frontendPostsInput = array(
            'title'     => $this->getInput('title', 1),
            'category'  => $this->getInput('category', 1),
        );
        
        if ( !$frontendPostsInput['title'] and !$frontendPostsInput['category'] ) {
            return;
        }
        
        $this->assertPostsGetterWrapper();
        $this->postsGetterWrapper->setInput($frontendPostsInput);
        
        $this->setRecords( $this->postsGetterWrapper->getRecords() );
        
        $records = $this->getRecords();
        if ( isset($records[0]) ) {
            $this->setTemplate($records[0]['template']);
        }
        
        return $this->getOutput();
    }

        /**
         * @throws \Application\Model\NullException
         */
        private function assertPostsGetterWrapper()
        {
            if (!$this->postsGetterWrapper) {
                $em = $this->getInput('entityManager');
                if ( $em instanceof \Doctrine\ORM\EntityManager ) {
                    $this->setPostsGetterWrapper(new PostsGetterWrapper(new PostsGetter($em)) );
                }
            }

            if (!$this->postsGetterWrapper) {
                throw new \Application\Model\NullException('PostsGetterWrapper instance is not set. Check out the Entity Manager input');
            }
        }

}