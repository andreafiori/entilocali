<?php

namespace Setup;

class SetupManagerAlwaysToLoad extends SetupManagerAbstract implements SetupManagerAlwaysToLoadInterface
{
	private $className, $record;

	public function setClassName($className)
	{
		if ( !class_exists($className) )
		{
			return false;
		}
		
		$this->className = $className;

		return $this->className;
	}
	
	public function getClassName()
	{
		return $this->className;
	}
	
	public function setRecord()
	{
		$className = $this->getClassName();
		if ( !is_object($className) ) {
			$this->record = array();
		} else {
			$instance = new $className();
			if ( $instance instanceof SetupManagerAlwaysToLoadInterface ) {
				$this->record = $instance->getRecord();
			}
		}
		
		return $this->getRecord();
	}
	
	public function getRecord($key = null)
	{
		if (isset($this->record[$key]) and $key != null) {
			return $this->record[$key];
		}
		
		return $this->record ? $this->record : array();
	}
}