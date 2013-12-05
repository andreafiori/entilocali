<?php

namespace Application\Model;

use Zend\Db\TableGateway\TableGateway;
use Application\Model\User;

class UserTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll()
	{
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	public function getUserByEmail($email)
	{
		$rowset = $this->tableGateway->select(array('email' => $email));
		$row = $rowset->current();
		return $row;
	}
	
	/**
	 * 
	 * @param   User $user
	 * @throws  \Exception
	 * @return   
 	 */
	public function saveUser(User $user)
	{
		$data = array(
			'id' => $user->id,
			'name' => $user->name,
			'email'  => $user->email,
		);
		
		$id = (int) $user->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
			return $this->tableGateway->lastInsertValue;
		} else {
			if ($this->getUserByEmail($user->email)) {
				$this->tableGateway->update($data, array('id' => $user->id));
			} else {
				throw new \Exception('User id does not exist');
			}
		}
	}

	public function deleteUser($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}
