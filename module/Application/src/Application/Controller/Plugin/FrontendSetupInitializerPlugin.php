<?php

namespace Application\Controller\Plugin;

/**
 * @author Andrea Fiori
 * @since  01 February 2014
 */
class FrontendSetupInitializerPlugin extends SetupInitializerAbstractPlugin
{
	/**
	 * @return array
	 */
	protected function getInput()
	{
		return array(
				'isbackend' 			=> 0,
				'channel'				=> 1,
				'controller'			=> $this->getRoute('controller'),
				'action'				=> $this->getRoute('action'),
				'languageAbbreviation' 	=> $this->getRoute('lang'),
				'categoryName' 			=> is_string($this->getRoute('category')) ? \Setup\StringRequestDecoder::slugify( $this->getRoute('category') ) : '',
				'title'		 			=> is_string($this->getRoute('category')) ? \Setup\StringRequestDecoder::slugify( $this->getRoute('title') ) : '',
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