<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsFrontend;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsFrontendTest extends TestSuite
{
    private $input;
    
    private $postsFrontend;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->input = $this->getFrontendCommonInput();
        
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
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
        
        $this->assertTrue( is_array($this->postsFrontend->setupRecord($postsGetterWrapper)) );
        $this->assertEquals(PostsFrontend::defaultFrontendTemplate, $this->postsFrontend->getTemplate());
        $this->assertTrue(is_array($this->postsFrontend->getRecords()));
    }
}
