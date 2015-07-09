<?php

namespace ModelModuleTest\Model\Posts;

use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ModelModuleTest\TestSuite;

class PostsGetterWrapperTest extends TestSuite
{
    /**
     * @var PostsGetterWrapper
     */
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();

        $this->objectWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetInput()
    {
        $this->objectWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->objectWrapper->getInput()) );
    }

    public function testGetRecords()
    {
        $this->objectWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->objectWrapper->getRecords()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }

    public function testSddCategorySlugToRecordset()
    {
        $records = $this->objectWrapper->addCategorySlugToRecordset(
            array(
                array(
                    'title' => 'my 1st post title',
                    'categoryName' => 'my post category',
                ),
                array(
                    'title' => 'my 2st post title',
                    'categoryName' => 'second category',
                ),
            )
        );

        $this->assertEquals($records[0]['categorySlug'], 'my-post-category');
    }
}
