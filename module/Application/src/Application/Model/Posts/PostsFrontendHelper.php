<?php

namespace Application\Model\Posts;

use Admin\Model\InputSetupAbstract;
use Application\Model\NullException;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  24 May 2014
 */
class PostsFrontendHelper extends InputSetupAbstract
{
    private $category, $title;
    
    /** @var  \Admin\Model\Posts\PostsGetterWrapper **/
    private $postsGetterWrapper;
    
    private $isHomePage = false;
    private $records;
    
    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        parent::__construct($input);
        
        $this->category = $this->getInput('category', 1);
        $this->title = $this->getInput('title', 1);
        
        if ( !$this->category and !$this->title ) {
            $this->isHomePage = true;
        }
    }
    
    /**
     * @return type
     */
    public function isHomePage()
    {
        return $this->isHomePage;
    }
    
    public function setRecords()
    {
        $this->assertPostsGetterWrapper();
        
        $this->postsGetterWrapper->setInput($this->getInput());
        $this->postsGetterWrapper->setupQueryBuilder();
        
        $this->records = $this->postsGetterWrapper->getRecords();
        
        return $this->records;
    }

    /**
     * Ensure the PostsGetterWrapper is set (public for tests)
     * 
     * @return \Doctrine\ORM\EntityManager
     * @throws NullException
     */
    public function assertPostsGetterWrapper()
    {
        $em = $this->getInput('entityManager', 1);
        if ( isset($em) and !isset($this->postsGetterWrapper) ) {

            if ( $em instanceof \Doctrine\ORM\EntityManager ) {
                $this->postsGetterWrapper = new PostsGetterWrapper(new PostsGetter($em));
                return $this->postsGetterWrapper;
            }

        }

        throw new NullException('PostsGetterWrapper instance is not set. Check out the Entity Manager input');
    }
    
    /**
     * Overwrite parent method
     * 
     * @return string 
     */
    public function getTemplate()
    {
        if ( isset($this->records[0]['template']) ) {
            return $this->records[0]['template'];
        }
        
        return 'notfound.phtml';
    }
}
