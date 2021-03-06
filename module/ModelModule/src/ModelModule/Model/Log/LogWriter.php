<?php

namespace ModelModule\Model\Log;

use ModelModule\Model\Database\DbTableContainer;
use ModelModule\Model\NullException;

class LogWriter
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $connection;

    /**
     * @param \Doctrine\DBAL\Connection $connection
     */
    public function __construct(\Doctrine\DBAL\Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Write log. Call this method under a try \ catch with beginTransaction and rollback methods
     *
     * @param array $arrayValues
     * @return bool
     */
    public function writeLog(array $arrayValues)
    {
        $arrayValues = $this->validateValues($arrayValues);

        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert(DbTableContainer::logs, $arrayValues);
            $this->getConnection()->commit();
        } catch(\Exception $e) {
            $this->getConnection()->rollBack();
        }

        return true;
    }

        /**
         * @param array $arrayValues
         *
         * @return array
         *
         * @throws NullException
         */
        private function validateValues(array $arrayValues)
        {
            if (!isset($arrayValues['user_id'])) {
                throw new NullException('User ID is not set');
            }

            if (!isset($arrayValues['module_id'])) {
                throw new NullException('Module ID is not set');
            }

            if (!isset($arrayValues['message'])) {
                throw new NullException('Message text is not set');
            }

            if (!isset($arrayValues['reference_id'])) {
                $arrayValues['reference_id'] = 0;
            }

            if (!isset($arrayValues['backend'])) {
                $arrayValues['backend'] = 0;
            }

            $arrayValues['datetime'] = date("Y-m-d H:i:s");

            return $arrayValues;
        }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    public function getConnection()
    {
        return $this->connection;
    }
}