<?php

namespace ApplicationTest\Model\Contatti;

use ApplicationTest\TestSuite;
use Application\Model\Contatti\ContattiFrontend;
use Application\Model\Posts\PostsGetterWrapper;
use Application\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 May 2014
 */
class ContattiFrontendTest extends TestSuite
{
    private $contattiFrontend;
    private $input;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->input = $this->getFrontendCommonInput();
        
        $this->postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
   
        $this->contattiFrontend = new ContattiFrontend();
        $this->contattiFrontend->setInput($this->input);
    }

    public function testSetupRecord()
    {
        $this->assertFalse( $this->contattiFrontend->setupRecord($this->postsGetterWrapper) );
    }
}
