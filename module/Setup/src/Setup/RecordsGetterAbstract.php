<?php

namespace Setup;

/**
 * RecordsGetterAbstract
 * @author Andrea Fiori
 * @since  22 January 2014
 */
abstract class RecordsGetterAbstract
{
	protected $input;
	
	protected $setupManager;
	
	protected $queryBuilder;
	
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
	
	public function getInput($key=null)
	{
		if ($key) {
			return $this->input[$key];
		}
		
		return $this->input;
	}
	
	/**
	 * @return SetupManager
	 */
	public function getSetupManager()
	{
		return $this->setupManager;
	}
	
	/**
	 * 
	 * @param DQLQueryHelper $queryBuilder
	 * @return DQLQueryHelper
	 */
	public function setQueryBuilder(DQLQueryHelper $queryBuilder)
	{
		$this->queryBuilder = $queryBuilder;
	
		return $this->queryBuilder;
	}
	
	/**
	 * 
	 * @return DQLQueryHelper
	 */
	public function getQueryBuilder()
	{
		return $this->queryBuilder;
	}
}