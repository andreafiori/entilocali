<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;
use Backend\Form\PostsForm;

/**
 * FormSetterAbstractTest
 * @author Andrea Fiori
 * @since  26 January 2014
 */
class FormSetterAbstractTest extends TestSuite
{
	private $formSetterAbstract;

	private $setupManager;

	protected function setUp()
	{
		parent::setUp();
		
		$this->setupManager = $this->getSetupManager();
		
		$this->formSetterAbstract = $this->getMockForAbstractClass('Backend\Model\FormSetterAbstract', array( $this->setupManager ) );
	}

	public function testSetForm()
	{
		$this->formSetterAbstract->setForm( new PostsForm($this->setupManager) );
		
		$this->assertTrue( $this->formSetterAbstract->getForm() instanceof \Zend\Form\Form);
	}
}