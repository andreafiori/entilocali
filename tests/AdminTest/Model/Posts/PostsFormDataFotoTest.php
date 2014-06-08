<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsFormDataFoto;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataFotoTest extends TestSuite
{
    private $postsFormDataFoto;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataFoto = new PostsFormDataFoto($this->getFrontendCommonInput());
    }
    
    public function testSetProperties()
    {
        $this->postsFormDataFoto->setProperties();
        
        $this->assertTrue(is_numeric($this->postsFormDataFoto->getProperty('moduloId')) );
        $this->assertNotEmpty($this->postsFormDataFoto->getProperty('description'));
    }
}