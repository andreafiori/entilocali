<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsFormDataHandler;

/**
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class PostsFormDataHandlerTest extends TestSuite
{
    private $postsFormDataHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataHandler = new PostsFormDataHandler( $this->getFrontendCommonInput() );
    }
    
    public function testGetForm()
    {
        $this->assertInstanceOf('\Admin\Model\Posts\PostsForm', $this->postsFormDataHandler->getForm() );
    }
    
    public function testGetTitle()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getTitle()) );
    }
    
    public function testGetDescription()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getDescription()) );
    }
    
    public function testgetFormAction()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getFormAction()) );
    }
}