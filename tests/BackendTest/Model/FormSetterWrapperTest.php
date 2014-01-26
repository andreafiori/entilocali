<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Model\FormSetterAbstract;
use Posts\Model\PostsFormSetter;
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
	
	public function testSetFormSetter()
	{
		$this->formSetterWrapper->setFormSetter( new PostsFormSetter($this->setupManager) );
		
		$this->assertTrue( $this->formSetterWrapper->getFormSetter() instanceof FormSetterAbstract );
	}
	
	public function testSetFormSetterRecord()
	{
		$this->formSetterWrapper->getFormSetter()->setRecord(1);

		$this->formSetterWrapper->getFormSetter()->getRecord();
	}
}