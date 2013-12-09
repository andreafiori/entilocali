<?php
namespace LanguageLabels\Model;

use Zend\Db\TableGateway\TableGateway;

class LanguageLabelsTable
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

    public function getLanguageLabels($id)
    {
        $id  = (int) $id;
        $rowset = $this->tableGateway->select(array('id' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveLanguageLabels(LanguageLabels $config)
    {
        $data = array(
            'name' => $config->name,
        );

        $id = (int)$config->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLanguageLabels($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('LanguageLabels record id does not exist');
            }
        }
    }

    public function deleteLanguageLabels($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}