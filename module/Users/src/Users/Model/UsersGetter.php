<?php

namespace Users\Model;

use Setup\SetupManager;
use Setup\RecordsGetterAbstract;

/**
 * @author Andrea Fiori
 * @since  22 January 2014
 */
class UsersGetter extends RecordsGetterAbstract
{
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function getUser()
	{
		return false;
	} 
}