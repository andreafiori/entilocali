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

    public function fetchAll()
    {
        $resultSet = $this->tableGateway->select();
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
            'language' => $language->language,
            'abbrev1'  => $language->abbrev1,
        	'abbrev2'  => $language->abbrev2,
        	'abbrev3'  => $language->abbrev3,
        	/*
        	'defaultlang'  => $language->defaultlang,
        	'defaultlang_admin'  => $language->defaultlang_admin,
        	'encoding'  => $language->encoding,
        	'flag'  => $language->flag,
        	'active'  => $language->active,
        	'channel_id'  => $language->channel_id,
        	*/
        );

        $id = (int)$language->id;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLanguage($id)) {
                $this->tableGateway->update($data, array('id' => $id));
            } else {
                throw new \Exception('Form id does not exist');
            }
        }
    }

    public function deleteLanguage($id)
    {
        $this->tableGateway->delete(array('id' => $id));
    }
}