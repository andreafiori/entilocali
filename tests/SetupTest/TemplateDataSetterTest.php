<?php

namespace SetupTest;

use SetupTest\TestSuite;
use Setup\TemplateDataSetter;
use Setup\SetupManager;

class TemplateDataSetterTest extends TestSuite {

	private $templateDataSetter;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->templateDataSetter = new TemplateDataSetter( new SetupManager(array("channel"=>1,"language"=>1)) );
	}
	
	/**
	 * @expectedException \Setup\NullException
	 */
	public function testMergeTemplateDataWithArrayLaunchNullException()
	{
		$this->templateDataSetter->mergeTemplateDataWithArray(array("myKey"=>"myValue"));
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
}