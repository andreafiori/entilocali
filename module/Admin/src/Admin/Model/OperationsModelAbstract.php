<?php

namespace Admin\Model;

use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\Connection;
use Application\Model\NullException;
use Admin\Model\Log\LogWriter;

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
     * @param object $wrapper
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
     * @param \Application\Model\RecordsGetterWrapperAbstract $wrapper
     * @param $input
     * @return \Application\Model\RecordsGetterWrapperAbstract
     */
    public function recoverWrapper($wrapper, $input)
    {
        $wrapper->setInput($input);

        $wrapper->setupQueryBuilder();

        return $wrapper;
    }

    /**
     * @param \Application\Model\RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @param int $page
     * @param int $perPage
     * @return mixed
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
     * @param $idFieldName
     * @param $valueFieldName
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
}