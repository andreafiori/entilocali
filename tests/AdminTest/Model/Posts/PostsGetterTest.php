<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsGetterTest extends TestSuite
{
    private $postsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsGetter = new PostsGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->postsGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->postsGetter->getQueryResult()) );
    }
    /*
    public function testSetId()
    {
        $this->postsGetter->setId(1);
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND p.id = ")!== false );
    }
    
    public function testSetCategoryName()
    {
        $this->postsGetter->setCategoryName('MyPostCategory');
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND co.name = ")!== false );
    }
    
    public function testSetTitle()
    {
        $this->postsGetter->setTitle('MyPostTitle');
        
        $this->assertTrue( strpos($this->postsGetter->getQuery(), "AND po.title = ")!== false );
    }
    */
}
