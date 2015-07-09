<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Attachments\AttachmentsGetter;
use ModelModule\Model\Attachments\AttachmentsGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class AttachmentsGetterWrapperTest extends TestSuite
{
    private $objectWrapper;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectWrapper = new AttachmentsGetterWrapper( new AttachmentsGetter($this->getEntityManagerMock()) );
    }
    
    public function testSetupQueryBuilder()
    {
        $this->assertNull( $this->objectWrapper->setupQueryBuilder() );
    }
}

