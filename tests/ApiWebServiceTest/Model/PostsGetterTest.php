<?php

namespace ApiWebServiceTest\Model;

use ApplicationTest\TestSuite;
use ApiWebService\Model\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterTest extends TestSuite
{
    private $postsGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsGetter = new PostsGetter( $this->getDoctrineEntityManager() );
    }
    
    public function testConstruct()
    {
        $this->assertEquals(1, 1);
    }
}
