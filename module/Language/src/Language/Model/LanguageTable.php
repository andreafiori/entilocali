<?php
namespace Language\Model;

use Zend\Db\TableGateway\TableGateway;

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

    public function saveLanguage(Language $config)
    {
        $data = array(
            'name' => $config->name,
            'value'  => $config->value,
        	'isadmin'  => $config->isadmin,
        	'rifmodule'  => $config->rifmodule,
        	'rifchannel'  => $config->rifchannel,
        	'riflanguage'  => $config->riflanguage,
        );

        $id = (int)$config->id;
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