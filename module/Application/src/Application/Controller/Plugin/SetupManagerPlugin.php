<?php

namespace Application\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Setup\SetupManagerWrapper;
use Setup\SetupManager;

/**
 * SetupManagerPlugin
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
		$setupManagerWrapper = new SetupManagerWrapper( new SetupManager($input) );
		$setupManagerWrapper->detectChannel();
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
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
}