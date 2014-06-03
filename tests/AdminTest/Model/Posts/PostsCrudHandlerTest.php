<?php

namespace Admin\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsCrudHandler;

/**
 * @author Andrea Fiori
 * @since  01 June 2014
 */
class PostsCrudHandlerTest extends TestSuite
{
    private $postsCrudHandler;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsCrudHandler = new PostsCrudHandler($this->getFrontendCommonInput());
    }
    
    public function testPerformOperation()
    {
        
        $this->postsCrudHandler->performOperation();
        
    }
}