<?php

namespace ModelModuleTest\Model\Attachments;

use ModelModuleTest\TestSuite;
use ModelModule\Model\Attachments\AttachmentsGetter;

/**
 * @author Andrea Fiori
 * @since  18 August 2014
 */
class AttachmentsGetterTest extends TestSuite
{
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new AttachmentsGetter( $this->getEntityManagerMock() );
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
    
    public function testSetModuleId()
    {
        $this->objectGetter->setModuleId(6);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('moduleId'));
    }
    
    public function testSetReferenceId()
    {
        $this->objectGetter->setReferenceId(11);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('referenceId'));
    }
    
    public function testSetAttachmentId()
    {
        $this->objectGetter->setAttachmentId(11);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('attachmentId'));
    }
}
