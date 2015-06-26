<?php

namespace ModelModule\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;
use ModelModule\Model\Log\LogWriter;

abstract class OperationsModelAbstract
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var Connection
     */
    protected $connection;

    /**
     * @var LogWriter
     */
    protected $logWriter;

    protected $wrapper;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @throws NullException
     */
    protected function assertEntityManager()
    {
        if (!$this->getEntityManager()) {
            throw new NullException("EntityManager is not set");
        }
    }

    /**
     * @return Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @throws NullException
     */
    public function assertConnection()
    {
        if (!$this->getConnection()) {
            throw new NullException("Connection is not set");
        }
    }

    /**
     * @param Connection $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function setupConnection()
    {
        $this->assertEntityManager();

        $this->connection = $this->getEntityManager()->getConnection();
    }

    /**
     * @param LogWriter $logWriter
     */
    public function setLogWriter($logWriter)
    {
        $this->logWriter = $logWriter;
    }

    /**
     * @return LogWriter
     */
    public function getLogWriter()
    {
        return $this->logWriter;
    }

    /**
     * Write log using logWriter object
     *
     * @param array $logArray
     */
    public function writeLog($logArray)
    {
        $this->assertLogWriter();

        $this->getLogWriter()->writeLog($logArray);
    }

    /**
     * @throws NullException
     */
    protected function assertLogWriter()
    {
        if (!$this->getLogWriter()) {
            throw new NullException("LogWriter is not set");
        }
    }

    /**
     * @param \ModelModule\Model\RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @return array
     */
    public function recoverWrapperRecords($wrapper, $input)
    {
        $wrapper->setInput($input);

        $wrapper->setupQueryBuilder();

        return $wrapper->getRecords();
    }

    /**
     * @param \ModelModule\Model\RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @param int $id
     * @return \ModelModule\Model\RecordsGetterWrapperAbstract|bool
     */
    public function recoverWrapperById($wrapper, $input, $id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        return $this->recoverWrapper($wrapper, $input);
    }

    /**
     * @param \ModelModule\Model\RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @param int $id
     * @return array|bool
     */
    public function recoverWrapperRecordsById($wrapper, $input, $id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        return $this->recoverWrapperRecords($wrapper, $input);
    }

    /**
     * @param \ModelModule\Model\RecordsGetterWrapperAbstract $wrapper
     * @param $input
     * @return \ModelModule\Model\RecordsGetterWrapperAbstract
     */
    public function recoverWrapper($wrapper, $input)
    {
        $wrapper->setInput($input);

        $wrapper->setupQueryBuilder();

        return $wrapper;
    }

    /**
     * Recover a wrapper with paginator set
     *
     * @param \ModelModule\Model\RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @param int $page
     * @param int $perPage
     * @return \ModelModule\Model\RecordsGetterWrapperAbstract
     */
    public function recoverWrapperRecordsPaginator($wrapper, $input, $page, $perPage = null)
    {
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($wrapper->getObjectGetter()->getEntityManager()) );
        $wrapper->setupPaginatorCurrentPage($page);
        $wrapper->setupPaginatorItemsPerPage($perPage);

        return $wrapper;
    }

    /**
     * @param array $recordset
     * @param string $idFieldName
     * @param string $valueFieldName
     * @return array|bool
     */
    public function formatForDropwdown($recordset, $idFieldName, $valueFieldName)
    {
        if (!empty($recordset)) {

            $arrayToReturn = array();

            foreach($recordset as $record) {

                if (!isset($record[$idFieldName])) {
                    break;
                }

                $arrayToReturn[$record[$idFieldName]] = isset($record[$valueFieldName]) ? $record[$valueFieldName] : null;
            }

            return $arrayToReturn;
        }

        return false;
    }

    /**
     * @param array|null $records
     * @param string $message
     * @throws NullException
     */
    public function checkRecords($records, $message ='Empty records')
    {
        if ( empty($records) ) {
            throw new NullException($message);
        }
    }

    /**
     * @param mixed $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;
    }

    /**
     * @return mixed
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }

    /**
     * @param string $message
     * @throws NullException
     */
    protected function assertWrapper($message = 'Object wrapper is not set')
    {
        if (!$this->getWrapper()) {
            throw new NullException($message);
        }
    }
}