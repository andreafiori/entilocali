<?php

namespace Setup;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
abstract class SetupManagerPreloadAbstract extends SetupManagerAbstract
{
	protected $record;
	
	protected $className, $classInstance;

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

	abstract public function setRecord();

	public function getRecord($key = null)
	{
		if (isset($this->record[$key]) and $key != null) {
			return $this->record[$key];
		}

		return $this->record ? $this->record : array();
	}
	
	public function setClassInstance(SetupManager $setupManager)
	{
		$className = $this->getClassName();
		if (!$className) {
			return false;
		}
		
		$classInstance = new $className($setupManager);
		if ($classInstance instanceof SetupManagerAlwaysToLoadInterface) {
			$this->classInstance = $classInstance;
		}
		
		return $this->classInstance ?  $this->classInstance : false;
	}
	
	public function getClassInstance()
	{
		return $this->classInstance;
	}
}