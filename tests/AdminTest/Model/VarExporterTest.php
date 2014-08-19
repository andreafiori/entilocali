<?php

namespace AdminTest\Model;

use ApplicationTest\TestSuite;

/**
 * @author Andrea Fiori
 * @since  30 July 2014
 */
class VarExporterTest extends TestSuite
{
    private $varExporter;
    
    protected function setUp()
    {
        parent::setUp();

        $this->varExporter = $this->getMockForAbstractClass('Admin\Model\VarExporter', array( $this->getFrontendCommonInput() ) );
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
