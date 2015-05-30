<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Attachments\AttachmentsMimetypeGetter;

/**
 * @author Andrea Fiori
 * @since  20 December 2014
 */
class AttachmentsMimertypeGetterTest extends TestSuite
{
    /**
     * @var AttachmentsMimetypeGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AttachmentsMimetypeGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetId()
    {
        $this->objectGetter->setId(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetIdWithArrayInInput()
    {
        $this->objectGetter->setId( array(1,2,3) );
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('id'));
    }

    public function testSetMimeType()
    {
        $this->objectGetter->setMimeType('text/plain');

        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('mimetype'));
    }
}
