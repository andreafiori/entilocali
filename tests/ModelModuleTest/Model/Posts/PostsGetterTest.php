<?php

namespace ModelModuleTest\Model\Posts;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Posts\PostsGetter;

class PostsGetterTest extends TestSuite
{
    /**
     * @var PostsGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new PostsGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->objectGetter->setId(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }
    
    public function testSetIdWithArrayParameter()
    {
        $this->objectGetter->setId(array(1,2,3));
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetCategorySlug()
    {
        $this->objectGetter->setCategorySlug('my-category-slug');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('categorySlug'));
    }

    public function testSetTitle()
    {
        $this->objectGetter->setTitle('MyPostTitle');
        
         $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('title'));
    }
    
    public function testSetType()
    {
        $this->objectGetter->setType('content');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('postType'));
    }
    
    public function testSetStatus()
    {
        $this->objectGetter->setStatus();
        $this->assertEmpty($this->objectGetter->getQueryBuilder()->getParameter('status'));
        
        $this->objectGetter->setStatus('active');
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('status'));
    }

    public function testModuleCode()
    {
        $this->objectGetter->setModuleCode('blogs');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('moduleCode'));
    }

    public function testSetLanguageId()
    {
        $this->objectGetter->setLanguageId(2);

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('language'));
    }

    public function testSetLanguageAbbreviation()
    {
        $this->objectGetter->setLanguageAbbreviation('en');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('languageAbbr'));
    }
}
