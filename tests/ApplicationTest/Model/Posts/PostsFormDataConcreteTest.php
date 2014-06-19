<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsFormDataConcrete;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  18 June 2014
 */
class PostsFormDataConcreteTest extends TestSuite
{
    private $postsFormDataConcrete;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataConcrete = new PostsFormDataConcrete($this->getFrontendCommonInput());
    }
    
    public function testPostsFormDataSetup()
    {
        $this->postsFormDataConcrete->setPostsGetterWrapper( new PostsGetterWrapper(new PostsGetter($this->getEntityManagerMock())) );
    }
}