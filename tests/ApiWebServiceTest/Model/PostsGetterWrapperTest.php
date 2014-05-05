<?php

namespace ApiWebServiceTest\Model;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PostsGetter;
use Application\Model\Posts\PostsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class PostsGetterWrapperTest extends TestSuite
{
    private $postsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();

        $postsGetter = new PostsGetter( $this->getEntityManagerMock() );

        $this->postsGetterWrapper = new PostsGetterWrapper($postsGetter);
    }
    
    public function testSetInput()
    {
        $this->postsGetterWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->postsGetterWrapper->getInput()) );
    }

    public function testGetPostsGetter()
    {
        $this->assertTrue( $this->postsGetterWrapper->getPostsGetter() instanceof PostsGetter );
    }
    
    public function testGetRecords()
    {
        $this->postsGetterWrapper->setInput( array("id" => 1) );
        
        $this->assertTrue( is_array($this->postsGetterWrapper->getRecords()) );
    }
}
