<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  05 May 2014
 */
class PostsGetterTest extends TestSuite
{
    private $postsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsGetter = new PostsGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->postsGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->postsGetter->getQueryResult()) );
    }
}
