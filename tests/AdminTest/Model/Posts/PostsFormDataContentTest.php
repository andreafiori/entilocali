<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsFormDataContent;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataContentTest extends TestSuite
{
    private $postsFormDataContent;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataContent = new PostsFormDataContent($this->getFrontendCommonInput());
    }
    
    public function testSetProperties()
    {
        $this->postsFormDataContent->setProperties();
        
        $this->assertTrue(is_numeric($this->postsFormDataContent->getProperty('moduloId')) );
        $this->assertEquals($this->postsFormDataContent->getProperty('tipo'), 'content');
        $this->assertNotEmpty($this->postsFormDataContent->getProperty('description'));
    }
}