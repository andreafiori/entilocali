<?php

namespace AdminTest\Model\Posts;

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
    
    public function testSetId()
    {
        $this->postsGetter->setId(1);
        
        $this->assertNotEmpty($this->postsGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetCategoryName()
    {
        $this->postsGetter->setCategoryName('MyPostCategory');
        
        $this->assertNotEmpty($this->postsGetter->getQueryBuilder()->getParameter('categoryName'));
    }

    public function testSetTitle()
    {
        $this->postsGetter->setTitle('MyPostTitle');
        
         $this->assertNotEmpty($this->postsGetter->getQueryBuilder()->getParameter('title'));
    }
    
    public function testSetType()
    {
        $this->postsGetter->setType('content');

        $this->assertNotEmpty($this->postsGetter->getQueryBuilder()->getParameter('postType'));
    }
    
    public function testSetStatus()
    {
        $this->postsGetter->setStatus();
        $this->assertEmpty($this->postsGetter->getQueryBuilder()->getParameter('status'));
        
        $this->postsGetter->setStatus('active');
        $this->assertNotEmpty($this->postsGetter->getQueryBuilder()->getParameter('status'));
    }
    
    public function testSetOrderBy()
    {
        $this->postsGetter->setOrderBy('name');
        
        $this->assertEmpty($this->postsGetter->getQueryBuilder()->getParameter('orderBy'));
    }
}
