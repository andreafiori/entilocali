<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsGetter;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Categories\CategoriesGetter;
use Admin\Model\Categories\CategoriesGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataAbstractTest extends TestSuite
{
    private $postsFormDataAbstract;

    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataAbstract = $this->getMockForAbstractClass('\Admin\Model\Posts\PostsFormDataAbstract', array( $this->getFrontendCommonInput() ) );
    }

    public function testSetPostsGetterWrapper()
    {
        $this->assertInstanceOf(
            '\Admin\Model\Posts\PostsGetterWrapper', 
            $this->postsFormDataAbstract->setPostsGetterWrapper( new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock())) )
        );
    }
    
    public function testSetCategorieGetterWrapper()
    {
        $this->assertInstanceOf(
            '\Admin\Model\Categories\CategoriesGetterWrapper', 
            $this->setupCategorieGetterWrapper()
        );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetCategoriesRecordsThrowsException()
    {
        $this->postsFormDataAbstract->setCategoriesRecords();
    }
    
    public function testSetCategoriesRecords()
    {
        $this->setupCategorieGetterWrapper();
        
        $this->assertTrue(is_array($this->postsFormDataAbstract->setCategoriesRecords()) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetRecordByIdThrowsException()
    {
        $this->postsFormDataAbstract->setRecordById(1);
    }

    public function testSetRecordById()
    {
        $this->assertFalse( $this->postsFormDataAbstract->setRecordById('invalidNumber') );
  
        $this->setupPostsGetterWrapper();

        $this->assertTrue( is_array($this->postsFormDataAbstract->setRecordById(1)) );
    }
    
        /**
         * @return \Admin\Model\Categories\CategoriesGetterWrapper
         */
        private function setupCategorieGetterWrapper()
        {
            return $this->postsFormDataAbstract->setCategoriesGetterWrapper( new CategoriesGetterWrapper(new CategoriesGetter($this->getEntityManagerMock())) );
        }
        
        private function setupPostsGetterWrapper()
        {
            return $this->postsFormDataAbstract->setPostsGetterWrapper( new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) ) );
        }
}
