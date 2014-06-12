<?php

namespace ApplicationTest\Model\Contacts;

use ApplicationTest\TestSuite;
use Application\Model\Contacts\ContactsFrontend;
use Admin\Model\Posts\PostsGetterWrapper;
use Admin\Model\Posts\PostsGetter;

/**
 * @author Andrea Fiori
 * @since  15 May 2014
 */
class ContactsFrontendTest extends TestSuite
{
    private $contactsFrontend;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->contactsFrontend = new ContactsFrontend();
        $this->contactsFrontend->setInput($this->getFrontendCommonInput());
    }

    public function testSetupRecord()
    {
        $postsGetterWrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManagerMock()) );
        
        $this->assertFalse( $this->contactsFrontend->setupRecord($postsGetterWrapper) );
    }
}
