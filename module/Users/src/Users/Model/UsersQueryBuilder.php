<?php

namespace Users\Model;

use Setup\DQLQueryHelper;

/**
 * 
 * @author Andrea Fiori
 * @since  14 January 2014
 */
class UsersQueryBuilder extends DQLQueryHelper
{
	public function setQueryBasic()
	{
		if (!$this->getDefaultFieldsSelect()) {
			$this->setDefaultFieldsSelect('DISTINCT(u.id) AS userid, u.name, u.email ');
		}
	
		$this->queryBasic = "SELECT ".$this->getDefaultFieldsSelect()." FROM Application\\Entity\\Users u, Application\\Entity\\UsersApiKeys ua, Application\\Entity\\UsersRoles ur WHERE ( (ua.userId = u.id) AND (u.roleId = ur.id) ) ";
	}

	public function setId($id)
	{
		$this->query .= "AND u.id = :id ";
	
		$this->addToBindParameters('id', $id);
	}

	public function setEmail($email)
	{
		$this->query .= "AND u.email = :email ";
		
		$this->addToBindParameters('email', $email);
	}
	
	// TODO: encode password with sha256 algorithm or md5 (initially)...
	public function setPassword($password)
	{
		$this->query .= "AND u.password = :password ";
		
		$this->addToBindParameters('password', md5($password) );
	}
}