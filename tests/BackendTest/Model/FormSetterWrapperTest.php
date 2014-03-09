<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Model\FormSetterWrapper;

/**
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class FormSetterWrapperTest extends TestSuite
{
	private $setupManager;
	
	private $formSetterWrapper;
	
	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->formSetterWrapper = new FormSetterWrapper($this->setupManager);
	}
	
	public function testSetFormSetterClassName()
	{
		$this->assertNotEquals($this->formSetterWrapper->setFormSetterClassName('PostsFormSetter'), 'PostsFormSetter');
	}

	public function testSetFormSetterInstance()
	{
		$this->assertFalse( is_object($this->formSetterWrapper->setFormSetterInstance()) );

		$this->formSetterWrapper->setFormSetterClassName('PostsFormSetter');
		
		$this->assertTrue( is_object($this->formSetterWrapper->setFormSetterInstance() ) );
	}

	public function testSetFormSetterRecord()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setFormSetterRecord(1);
		
		$this->assertTrue( is_array($this->formSetterWrapper->getFormSetterInstance()->getRecord()) );
	}
	
	/**
	 * if you set title, it will be null because setTitle is abstract
	 */
	public function testSetFormSetterTitle()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setFormSetterTitle('this is my form title');
		
		$this->assertNull( $this->formSetterWrapper->getFormSetterInstance()->getTitle() );
	}
	
	public function testSetFormSetterDescription()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setFormSetterDescription('my form description');
		
		$this->assertNull( $this->formSetterWrapper->getFormSetterInstance()->getDescription() );
	}
	
	public function testSetZendFormClassName()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->assertTrue( class_exists($this->formSetterWrapper->setZendFormClassName()) );
	}
	
	public function testSetZendFormInstance()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setZendFormClassName();
		
		$this->assertTrue( is_object($this->formSetterWrapper->setZendFormInstance()) );
	}
	
		private function setFormSetterWrapperClassNameAndInstance()
		{
			$this->formSetterWrapper->setFormSetterClassName('PostsFormSetter');
			$this->formSetterWrapper->setFormSetterInstance();
		}
}