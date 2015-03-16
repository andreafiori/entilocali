<?php

namespace AdminTest\Model\Config;

use ApplicationTest\TestSuite;
use Admin\Model\Config\ConfigGetter;

/**
 * @author Andrea Fiori
 * @since  01 November 2014
 */
class ConfigGetterTest extends TestSuite
{
    /**
     * @var ConfigGetter
     */
    private $objectGetter;
    
    protected function setUp()
    {
        parent::setUp();
        
        $this->objectGetter = new ConfigGetter( $this->getEntityManagerMock() );
    }
    
    public function testSetMainQuery()
    {
        $this->objectGetter->setMainQuery();
        
        $this->assertTrue( is_array($this->objectGetter->getQueryResult()) );
    }
    
    public function testSetChannel()
    {
        $this->objectGetter->setChannel(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('channel'));
    }

    public function testSetLanguage()
    {
        $this->objectGetter->setLanguage(1);
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('language'));
    }
    
    public function testSetName()
    {
        $this->objectGetter->setName('sitename');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('name'));
    }
    
    public function testSetValue()
    {
        $this->objectGetter->setValue('myValue');
        
        $this->assertNotEmpty($this->objectGetter->getQueryBuilder()->getParameter('value'));
    }
}
