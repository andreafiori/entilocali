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

    public function testGetTitle()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getPostsFormDataObject()->getTitle()) );
    }
    
    public function testGetDescription()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getPostsFormDataObject()->getDescription()) );
    }
    
    public function testGetForm()
    {
        $this->assertInstanceOf('\Admin\Model\Posts\PostsForm', $this->postsFormDataHandler->getPostsFormDataObject()->getForm() );
    }
    
    public function testGetFormAction()
    {
        $this->assertTrue( is_string($this->postsFormDataHandler->getFormAction('content')) );
    }
}