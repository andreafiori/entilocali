<?php

namespace ModelModuleTest\Model\Posts;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapperTest extends TestSuite
{
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
}
