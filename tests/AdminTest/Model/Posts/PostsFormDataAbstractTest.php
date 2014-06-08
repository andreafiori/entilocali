<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Categorie\CategorieGetter;
use Application\Model\Categorie\CategorieGetterWrapper;

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
            '\Application\Model\Posts\PostsGetterWrapper', 
            $this->postsFormDataAbstract->setPostsGetterWrapper( new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock())) )
        );
    }
    
    public function testSetCategorieGetterWrapper()
    {
        $this->assertInstanceOf(
            '\Application\Model\Categorie\CategorieGetterWrapper', 
            $this->setupCategorieGetterWrapper()
        );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testSetCategorieRecordsThrowsException()
    {
        $this->postsFormDataAbstract->setCategorieRecords();
    }
    
    public function testSetCategorieRecords()
    {
        $this->setupCategorieGetterWrapper();
        
        $this->assertTrue(is_array($this->postsFormDataAbstract->setCategorieRecords()) );
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
         * @return \Application\Model\Categorie\CategorieGetterWrapper
         */
        private function setupCategorieGetterWrapper()
        {
            return $this->postsFormDataAbstract->setCategorieGetterWrapper( new CategorieGetterWrapper( new CategorieGetter($this->getEntityManagerMock())));
        }
        
        private function setupPostsGetterWrapper()
        {
            return $this->postsFormDataAbstract->setPostsGetterWrapper( new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) ) );
        }
}
