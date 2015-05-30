<?php

namespace ModelModuleTest\Model;

use ModelModuleTest\TestSuite;

class VarExporterTest extends TestSuite
{
    /**
     * @var \ModelModule\Model\VarExporter
     */
    private $varExporter;
    
    protected function setUp()
    {
        parent::setUp();

        $this->varExporter = $this->getMockForAbstractClass('ModelModule\Model\VarExporter', array( $this->getFrontendCommonInput() ) );
    }

    public function testSetTemplate()
    {
        $this->assertEmpty( $this->varExporter->getTemplate() );
        
        $this->assertEquals($this->varExporter->setTemplate('myTemplateFile.html'), 'myTemplateFile.html');
    }
    
    public function testSetTitle()
    {
        $this->assertEquals($this->varExporter->setTitle('myTitle'), 'myTitle');
    }
    
    public function testSetDescription()
    {
        $this->assertEquals($this->varExporter->setDescription('myDescription'), 'myDescription');
    }
}
