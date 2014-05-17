<?php

namespace ApplicationTest\Model\Posts;

use ApplicationTest\TestSuite;
use Application\Model\Posts\FotoFrontend;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 May 2014
 */
class FotoFrontendTest extends TestSuite
{
    private $fotoFrontend;
    private $input;
    private $postsGetterWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->input = $this->getFrontendCommonInput();
        
        $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
        
        $this->fotoFrontend = new FotoFrontend();
        $this->fotoFrontend->setInput($this->input);
    }
    
    public function testSetupRecord()
    {
        $this->assertTrue( is_array($this->fotoFrontend->setupRecord($this->postsGetterWrapper)) );
    }
}
