<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsFormDataBlog;

/**
 * @author Andrea Fiori
 * @since  08 June 2014
 */
class PostsFormDataBlogTest extends TestSuite
{
    private $postsFormDataBlog;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsFormDataBlog = new PostsFormDataBlog($this->getFrontendCommonInput());
    }
    
    public function testSetProperties()
    {
        $this->postsFormDataBlog->setProperties();
        
        $this->assertTrue(is_numeric($this->postsFormDataBlog->getProperty('moduloId')) );
        $this->assertNotEmpty($this->postsFormDataBlog->getProperty('description'));
    }
}