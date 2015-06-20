<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\OperationsModelAbstract;
use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;

/**
 * TODO: turn this class into a controllerHelper and delete the methods. Use abstract methods, turn this file into a controller helper!
 */
class ContenutiOperationsModel extends OperationsModelAbstract
{
    private $contenutiGetterWrapper;

    private $contenutiRecords;

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $this->assertConnection();

        $this->getConnection()->delete(
            DbTableContainer::contenuti,
            array('id' => $id)
        );

        return true;
    }

    /**
     * @param mixed $contenutiGetterWrapper
     */
    public function setContenutiGetterWrapper($contenutiGetterWrapper)
    {
        $this->contenutiGetterWrapper = $contenutiGetterWrapper;
    }

    /**
     * @return mixed
     */
    public function getContenutiGetterWrapper()
    {
        return $this->contenutiGetterWrapper;
    }

    /**
     * @param array $input
     */
    public function setupContenutiRecords($input = array())
    {
        $this->assertContenutiGetterWrapper();

        $this->getContenutiGetterWrapper()->setInput($input);
        $this->getContenutiGetterWrapper()->setupQueryBuilder();

        $this->contenutiRecords = $this->getContenutiGetterWrapper()->getRecords();
    }

    private function assertContenutiGetterWrapper()
    {
        if (!$this->getContenutiGetterWrapper()) {
            throw new NullException("ContenutiGetterWrapper is not set");
        }
    }

    /**
     * @throws NullException
     */
    public function checkContenutiRecords()
    {
        $records = $this->getContenutiRecords();

        if ( empty($records) ) {
            throw new NullException("ContenutiRecords are empty or not set correctly");
        }
    }

    /**
     * @return mixed
     */
    public function getContenutiRecords()
    {
        return $this->contenutiRecords;
    }

    /**
     * @param int $id
     * @return int
     */
    public function annull($id)
    {
        $this->assertConnection();

        return $this->getConnection()->update(
            DbTableContainer::contenuti,
            array('attivo' => 0),
            array('id' => $id)
        );
    }

    /**
     * @param $id
     * @return bool
     */
    public function updateAttivo($id, $value = 1)
    {
        $this->assertConnection();

        $this->getConnection()->update(
            DbTableContainer::contenuti,
            array('attivo' => $value),
            array('id' => $id)
        );

        return true;
    }
}