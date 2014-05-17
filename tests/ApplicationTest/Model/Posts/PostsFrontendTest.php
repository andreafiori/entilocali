<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsFrontend;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontendTest extends TestSuite
{
    private $postsFrontend;
    private $input;
    private $postsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->input = $this->getFrontendCommonInput();
        
        $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
        
        $this->postsFrontend = new PostsFrontend();
        $this->postsFrontend->setInput($this->input);
    }
    
    /**
     * The the exception PostsGetterWrapper not set
     * 
     * @expectedException \Application\Model\NullException
     */
    public function testSetupFrontendRecordNullException()
    {
        unset($this->input['entityManager']);
        
        $this->postsFrontend->setInput($this->input);
        $this->postsFrontend->setupRecord();
    }
    
    public function testSetupRecord()
    {
        $this->assertTrue( is_array($this->postsFrontend->setupRecord($this->postsGetterWrapper)) );
    }
}
