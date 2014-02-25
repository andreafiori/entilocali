<?php

namespace Setup;

/**
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class SetupManagerPreload implements SetupManagerPreloadInterface
{
	private $className, $instance;
	
	private $record;

	public function setClassName($className)
	{
		if ( !class_exists($className) ) {
			return false;
		}
		
		$this->className = $className;

		return $this->className;
	}

	/**
	 * @return SetupManagerPreloadAbstract
	 */
	public function getClassName()
	{
		return $this->className;
	}
	
	public function setRecord()
	{
		$instance = $this->getInstance();
		if ( !$instance ) {
			return false;
		}
				
		return $instance->setRecord();
	}
	
	/**
	 * @return SetupManagerPreloadInterface
	 */
	public function getRecord($key = null)
	{
		if (isset($this->record[$key]) and $key != null) {
			return $this->record[$key];
		}

		return $this->record ? $this->record : array();
	}

	/**
	 * @param SetupManager $setupManager
	 * @return boolean|Ambigous <boolean, \Setup\SetupManagerPreloadInterface>
	 */
	public function setInstance(SetupManager $setupManager)
	{
		$className = $this->getClassName();
		if (!$className) {
			return false;
		}

		$instance = new $className($setupManager);
		if ($instance instanceof SetupManagerPreloadInterface) {
			$this->instance = $instance;
		}
		
		return $this->instance ?  $this->instance : false;
	}

	/**
	 * @return \Setup\SetupManagerPreloadInterface
	 */
	public function getInstance()
	{
		return $this->instance;
	}
}