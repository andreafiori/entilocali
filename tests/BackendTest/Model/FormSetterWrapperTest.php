<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Model\FormSetterWrapper;

/**
 * FormSetterWrapperTest
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
	
	/**
	 * TODO: mock the request to the db
	 */
	public function testSetFormSetterRecord()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setFormSetterRecord(1);
		
		$this->assertTrue( is_array($this->formSetterWrapper->getFormSetterInstance()->getRecord()) );
	}
	
	/*public function testSetFormSetterTitle()
	{
		$this->setFormSetterWrapperClassNameAndInstance();
		
		$this->formSetterWrapper->setFormSetterTitle();
		
		$this->assertNotEmpty( $this->formSetterWrapper->getFormSetterInstance()->getTitle() );
	}*/
	
	// public function testSetFormSetterDescription();
	
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
	
	//public function testInitializeForm()
	
	//public function setFormAction($action)

	//public function setFormAction($action)
	
		private function setFormSetterWrapperClassNameAndInstance()
		{
			$this->formSetterWrapper->setFormSetterClassName('PostsFormSetter');
			$this->formSetterWrapper->setFormSetterInstance();
		}
}