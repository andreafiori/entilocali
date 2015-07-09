<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetter;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetterWrapper;

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
