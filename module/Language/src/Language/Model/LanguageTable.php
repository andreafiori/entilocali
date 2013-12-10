<?php

namespace Language\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;

class LanguageTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}

	public function fetchAll($arrayWhere = null)
	{
		if ($arrayWhere!='' and !is_array($arrayWhere)) return false;
		$resultSet = $this->tableGateway->select($arrayWhere);
		return $resultSet;
	}

	public function fetchFrontendLanguage()
	{
		$resultSet = $this->tableGateway->select(function (Select $select) {
			$select->quantifier(new Expression('SQL_CALC_FOUND_ROWS'));
		});
		return $resultSet;
	}

	public function getLanguage($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}

	public function saveLanguage(Language $language)
	{
		$data = array(
				'id'  => $language->id,
				'language'  => $language->language,
				'abbrev1'  => $language->abbrev1,
				'abbrev2'  => $language->abbrev2,
				'abbrev3'  => $language->abbrev3,
		);

		$id = (int) $language->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getLanguage($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Language record id does not exist');
			}
		}
	}

	public function deleteLanguage($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}