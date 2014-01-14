<?php

namespace Setup;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class SetupManagerAlwaysToLoad extends SetupManagerAlwaysToLoadAbstract implements SetupManagerAlwaysToLoadInterface
{
	public function setRecord()
	{
		$className = $this->getClassName();
	}
}