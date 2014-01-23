<?php

namespace Setup;

/**
 * 
 * @author Andrea Fiori
 * @since  22 January 2014
 */
abstract class RecordsGetterAbstract
{
	protected $input;
	
	protected $setupManager;
	
	/**
	 * 
	 * @param  array $input
	 * @return array $input
	 */
	public function setInput(array $input)
	{
		$this->input = $input;
		
		return $this->input;
	}
	
	public function getInput()
	{
		return $this->input;
	}
	
	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
}