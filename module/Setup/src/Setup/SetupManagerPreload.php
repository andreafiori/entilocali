<?php

namespace Setup;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class SetupManagerPreload extends SetupManagerPreloadAbstract implements SetupManagerPreloadInterface
{
	public function setRecord()
	{
		$className = $this->getClassName();
	}
}