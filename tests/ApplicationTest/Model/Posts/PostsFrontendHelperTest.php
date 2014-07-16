<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsFrontendHelper;

/**
 * @author Andrea Fiori
 * @since  24 May 2014
 */
class PostsFrontendHelperTest extends TestSuite
{
    private $postsFrontendHelper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFrontendHelper = new PostsFrontendHelper($this->getFrontendCommonInput());
    }
    
    public function testIsOnTheHomePage()
    {
        $this->assertFalse( $this->postsFrontendHelper->isHomePage() );
    }
    
    public function testIsNotOnTheHomePage()
    {
        $postsFrontendHelper = new PostsFrontendHelper( array() );
        $this->assertTrue( $postsFrontendHelper->isHomePage() );
    }
    
    public function testAssertPostsGetterWrapper()
    {
        $this->assertTrue( is_object($this->postsFrontendHelper->assertPostsGetterWrapper()) );
    }
    
    /**
     * @expectedException \Application\Model\NullException
     */
    public function testAssertPostsGetterWrapperThrowException()
    {
        $postsFrontendHelper = new PostsFrontendHelper( array() );
        $postsFrontendHelper->assertPostsGetterWrapper();
    }
  
    public function testSetRecords()
    {
        $this->assertNotEmpty( $this->postsFrontendHelper->setRecords() );
    }
    
    public function testGetTemplate()
    {
        $this->assertEmpty( $this->postsFrontendHelper->getTemplate() );
    }
}