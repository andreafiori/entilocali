<?php

namespace Admin\Model\Logs;
use Application\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  15 February 2015
 */
class LogsWriter
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
     * @param array $arrayValues
     *
     * @return bool|string
     *
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function writeLog(array $arrayValues)
    {
        $this->getConnection()->beginTransaction();
        try {
            $arrayValues = $this->validateValues($arrayValues);

            $this->getConnection()->insert('zfcms_logs', $arrayValues);

            $this->getConnection()->commit();

        } catch (NullException $e) {
            $this->getConnection()->rollBack();

            return $e->getMessage();
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

            if (!isset($arrayValues['type'])) {
                $arrayValues['backend'] = 1;
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
        private function getConnection()
        {
            return $this->connection;
        }
}