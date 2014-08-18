<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsFrontend;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontendTest extends TestSuite
{
    private $postsFrontend;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFrontend = new PostsFrontend();
        $this->postsFrontend->setInput( $this->getFrontendCommonInput() );
    }
    
    public function testSetupRecord()
    {
        $this->assertNotEmpty($this->postsFrontend->setupRecord());
    }
}
