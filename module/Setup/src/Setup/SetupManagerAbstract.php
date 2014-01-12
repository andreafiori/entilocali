<?php

namespace Setup;

/**
 * SetupManagerAbstract
 * @author Andrea Fiori
 * @since  12 January 2014
 */
class SetupManagerAbstract
{
	protected $input;
	protected $entityManager;

	protected $channelId;
	protected $configRepository;

	protected $setupManagerLanguages, $setupManagerConfigurations;

	protected $templateDataSetter;

	/** @var controller to load on home page */
	protected $controllerHomePage;

	/** @var controller \ class with options to load always (if present) */
	protected $controllerAlwaysToLoad;

	public function setInput(array $input)
	{
		$this->input = $input;
	}

	public function getInput($key = null)
	{
		if (isset($this->input[$key])) {
			return $this->input[$key];
		} elseif (!isset($this->input[$key]) and $key!=null) {
			return false;
		}
		return $this->input;
	}

	public function getChannelId()
	{
		return $this->channelId;
	}
	
	public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function getEntityManager()
	{
		return $this->entityManager;
	}
	
	/**
	 * @return SetupManagerLanguages
	 */
	public function getSetupManagerLanguages()
	{
		return $this->setupManagerLanguages;
	}

	/**
	 * @return SetupManagerConfigurations
	 */
	public function getSetupManagerConfigurations()
	{
		return $this->setupManagerConfigurations;
	}
}