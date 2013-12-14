<?php

namespace Config\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;

class ConfigTable
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
    
    public function fetchFrontendConfig()
    {
    	$resultSet = $this->tableGateway->select(function (Select $select) {
	        $select->quantifier(new Expression('SQL_CALC_FOUND_ROWS'));
    	});
    	return $resultSet;
    }

    public function getConfig($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveConfig(Config $config)
    {
        $data = array(
        	'id'  => $config->id,
            'value'  => $config->value,
        	'isadmin'  => $config->isadmin,
        	'module_id'  => $config->module_id,
        	'channel_id'  => $config->channel_id,
        	'language_id'  => $config->language_id,
        );

        $id = (int)$config->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getConfig($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Config record id does not exist');
            }
        }
    }

    public function deleteConfig($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}