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
