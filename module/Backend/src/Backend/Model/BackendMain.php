<?php

namespace Backend\Model;

use Setup\SetupManager;

/**
 * 
 * @author Andrea Fiori
 * @since  23 January 2013
 */
class BackendMain
{
	private $router;

	private $setupManager;

	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}

	public function setRouter($router)
	{
		$this->router = $router;

		return $this->objectRouter;
	}
	
	public function getRouter()
	{
		return $this->objectRouter;
	}
}