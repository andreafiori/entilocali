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

	protected $setupManagerLanguages, $setupManagerLanguagesLabels;
	
	protected $setupManagerConfigurations;

	protected $templateDataSetter;
	
	protected $setupManagerAlwaysToLoad;

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

	public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
	{
		$this->entityManager = $entityManager;
	}

	public function getChannelId()
	{
		return $this->channelId ? $this->channelId : 1;
	}

	/**
	 * @return \Doctrine\ORM\EntityManager
	 */
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
	 * @return SetupManagerLanguagesLabels
	 */
	public function getSetupManagerLanguagesLabels()
	{
		return $this->setupManagerLanguagesLabels;
	}

	/**
	 * @return SetupManagerConfigurations
	 */
	public function getSetupManagerConfigurations()
	{
		return $this->setupManagerConfigurations;
	}
	
	public function getSetupManagerAlwaysToLoad()
	{
		return $this->setupManagerAlwaysToLoad;
	}
}