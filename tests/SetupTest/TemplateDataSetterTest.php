<?php

namespace SetupTest;

use Setup\TemplateDataSetter;
use Setup\SetupManager;

/**
 * TemplateDataSetter
 * @author Andrea Fiori
 * @since  07 January 2014
 */
class TemplateDataSetterTest extends TestSuite {

	private $templateDataSetter;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->templateDataSetter = new TemplateDataSetter( new SetupManager(array("channel"=>1,"language"=>1)) );
	}

	public function testMergeTemplateDataWithArray()
	{
		$this->templateDataSetter->setTemplateData(array("backend" => 0,"frontend" => 1));
		$this->templateDataSetter->mergeTemplateDataWithArray(array("myKey"=>"myValue"));
		
		$this->assertArrayHasKey('myKey', $this->templateDataSetter->getTemplateData());
	}
	
	public function testSetTemplateData()
	{
		$this->templateDataSetter->setTemplateData( array("backend" => 0, "frontend" => 1) );
		$this->assertEquals($this->templateDataSetter->getTemplateData(), array("backend" => 0, "frontend" => 1));
	}
	
	public function testAssignToTemplate()
	{
		$this->templateDataSetter->assignToTemplate('basePath', 'myBasePathDir');
		$this->assertArrayHasKey('basePath', $this->templateDataSetter->getTemplateData());
	}
}