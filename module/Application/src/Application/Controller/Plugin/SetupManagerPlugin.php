<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Setup\SetupManagerWrapper;
use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  24 January 2014
 */
class SetupManagerPlugin extends AbstractPlugin
{
	protected $setupManager;

	/**
	 * Common setup and initializations for frontend and backend
	 * @return SetupManager
	 */
	public function initialize(array $input)
	{
		$setupManager = new SetupManager($input);

		$setupManagerWrapper = new SetupManagerWrapper($setupManager);
		/* $setupManagerWrapper->detectChannel(); */
		$setupManagerWrapper->setupEntityManager( $setupManager->getEntityManager() );
		$setupManagerWrapper->setupLanguages();
		$setupManagerWrapper->setupLanguagesLabels();
		$setupManagerWrapper->setupConfigurations();
		$setupManagerWrapper->setupTemplateRecords();
		$setupManagerWrapper->setupPreloadRecord();
		
		return $this->setSetupManager( $setupManagerWrapper->getSetupManager() );
	}

	/**
	 * @param SetupManager $setupManager
	 * @return SetupManager
	 */
	public function setSetupManager(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
		
		return $this->setupManager;
	}

	/**
	 * @return SetupManager $this->setupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
}