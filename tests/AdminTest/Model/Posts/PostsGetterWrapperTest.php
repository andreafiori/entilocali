<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapperTest extends TestSuite
{
    private $postsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();

        $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetInput()
    {
        $this->postsGetterWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->postsGetterWrapper->getInput()) );
    }

    public function testGetPostsGetter()
    {
        $this->assertTrue( $this->postsGetterWrapper->getPostsGetter() instanceof PostsGetter );
    }

    public function testGetRecords()
    {
        $this->postsGetterWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->postsGetterWrapper->getRecords()) );
    }
    
    /*
    public function testSetupQueryBuilder()
    {
        $this->postsGetterWrapper->setupQueryBuilder();
        
        $this->assertEquals($this->postsGetterWrapper->getPostsGetter()->getQueryBuilder()->getParameter('language'), 1);
        $this->assertEquals($this->postsGetterWrapper->getPostsGetter()->getQueryBuilder()->getParameter('channel'), 1);
    }
    */
}
