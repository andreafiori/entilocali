<?php

namespace SetupTest\Model;

use SetupTests\Model\TestSuite;
use Setup\Model\SetupManager;
use Application\Controller\IndexController;

/**
 * TODO: test controller calls!!!
 * @author afiori
 *
 */
class SetupManagerTest // extends TestSuite
{
	
	private $setupManager;
	
	protected function setUp()
	{
		parent::setUp();

		$this->setupManager = new SetupManager( new IndexController() );
	}
	
	public function testSetEntityManager()
	{
		$this->setupManager->setEntityManager();
	}
	
	public function testSetInput()
	{
		$this->assertTrue(is_array($this->setupManager->setInput( array("channel"=>1) )));
	}
}