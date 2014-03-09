<?php

namespace BackendTest\Model;

use SetupTest\TestSuite;

/**
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

	public function testGetFromAbstractAreNull()
	{
		$this->assertEmpty( $this->formSetterAbstract->getRecord() );
		$this->assertEmpty( $this->formSetterAbstract->getTitle() );
		$this->assertEmpty( $this->formSetterAbstract->getDescription() );
	}
}