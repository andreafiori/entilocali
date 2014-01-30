<?php

namespace Backend\Controller\Plugin;

use Application\Controller\Plugin\SetupManagerPlugin;
use Application\Controller\Plugin\SetupInitializerAbstractPlugin;

/**
 * Backend SetupInitializer Plugin
 * @author Andrea Fiori
 * @since  27 December 2013
 */
class BackendSetupInitializerPlugin extends SetupInitializerAbstractPlugin
{
	/**
	 * @return array
	 */
	protected function getInput()
	{
		return array(
				'channel'				=> 1,
				'isbackend' 			=> 1,
				'controller'			=> $this->getRoute('controller'),
				'action'				=> $this->getRoute('action'),
				'languageAbbreviation' 	=> $this->getRoute('lang')
		);
	}

	/**
	 * @return SetupManagerPlugin
	 */
	public function getSetupManagerPlugin()
	{
		return $this->setupManagerPlugin;
	}
}