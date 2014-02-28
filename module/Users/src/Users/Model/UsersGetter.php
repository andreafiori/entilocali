<?php

namespace Users\Model;

use Users\Model\UsersQueryBuilder;
use Setup\SetupManager;

/**
 * @author Andrea Fiori
 * @since  22 January 2014
 */
class UsersGetter 
{
	/**
	 * @param SetupManager $setupManager
	 */
	public function __construct(SetupManager $setupManager)
	{
		$this->setupManager = $setupManager;
	}
	
	public function getUser($input)
	{
		if (is_array($input)) {
			$usersQueryBuilder = new UsersQueryBuilder();
			$usersQueryBuilder->setSetupManager($this->setupManager);
			$usersQueryBuilder->setId($input['id']);
			
			return $usersQueryBuilder->getSelectResult();
		}
	}
}