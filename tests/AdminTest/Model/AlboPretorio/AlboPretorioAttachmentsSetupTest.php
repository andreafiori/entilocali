<?php

namespace AdminTest\Model\AlboPretorio;

use ApplicationTest\TestSuite;
use Admin\Model\AlboPretorio\AlboPretorioAttachmentsSetup;

/**
 * @author Andrea Fiori
 * @since  28 October 2014
 */
class AlboPretorioAttachmentsSetupTest extends TestSuite
{
    private $alboPretorioAttachmentsSetup;
    
    private $classMapSample;
    
    protected function setUp()
    {
        $this->alboPretorioAttachmentsSetup = new AlboPretorioAttachmentsSetup();
        
        $this->classMapSample = array(
            'albo-pretorio'     => 'Admin\Model\AlboPretorio\AlboPretorioAttachmentsSetup',
            'photo'             => 'Admin\Model\UnexistentClassName'
        );
    }
    
    public function testSetModuleId()
    {
        $this->alboPretorioAttachmentsSetup->setModuleId(1);
        
        $this->assertEquals($this->alboPretorioAttachmentsSetup->getModuleId(), 1);
    }
    
    public function testSetModuleName()
    {
        $this->alboPretorioAttachmentsSetup->setModuleName('my-module-name');
        
        $this->assertEquals($this->alboPretorioAttachmentsSetup->getModuleName(), 'my-module-name');
    }
    
    public function testSetClassMap()
    {
        $this->alboPretorioAttachmentsSetup->setClassMap($this->classMapSample);
        
        $this->assertEquals($this->alboPretorioAttachmentsSetup->getClassMap(), $this->classMapSample);
    }
}
