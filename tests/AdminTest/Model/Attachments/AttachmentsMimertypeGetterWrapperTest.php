<?php

namespace AdminTest\Model\Attachments;

use ApplicationTest\TestSuite;
use Admin\Model\Attachments\AttachmentsMimetypeGetter;
use Admin\Model\Attachments\AttachmentsMimetypeGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class AttachmentsMimetypeGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttachmentsMimetypeGetterWrapper( new AttachmentsMimetypeGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}
