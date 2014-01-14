<?php

namespace Users\Model;

use Setup\DQLQueryHelper;

class UsersQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect('DISTINCT(u.id) AS userid, u.name, u.email ');
		}
	
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM users u, users_apikeys ua, users_roles ur WHERE ( (ua.user_id = u.id) AND (u.role_id = ur.id) ) ";
	}
	
}