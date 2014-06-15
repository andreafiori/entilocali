<?php

namespace AdminTest\Model\Posts;

use ApplicationTest\TestSuite;
use Admin\Model\Posts\PostsDataTable;

/**
 * @author Andrea Fiori
 * @since  31 May 2014
 */
class PostsDataTableTest extends TestSuite
{
    private $postsDataTable;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsDataTable = new PostsDataTable( $this->getFrontendCommonInput() );
    }
    
    public function testGetTitle()
    {
        $this->assertTrue( is_string($this->postsDataTable->getTitle() ) );
    }
}