<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\PhotoFrontend;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 May 2014
 */
class FotoFrontendTest extends TestSuite
{
    private $photoFrontend;

    private $postsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
        
        $this->photoFrontend = new PhotoFrontend();
        
        $this->photoFrontend->setInput($this->getFrontendCommonInput());
    }
    
    public function testSetupRecord()
    {
        $this->assertTrue( is_array($this->photoFrontend->setupRecord($this->postsGetterWrapper)) );
    }
}
