<?php

namespace Admin\Model\Logs;

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
     * @return mixed
     *
     * @throws \Doctrine\DBAL\ConnectionException
     */
    public function writeLog(array $arrayValues)
    {
        $this->getConnection()->beginTransaction();
        try {
            $this->getConnection()->insert('zfcms_logs', $arrayValues);
        } catch (\Exception $e) {
            $this->getConnection()->rollBack();

            return $e->getMessage();
        }
    }

        /**
         * @param array $arrayValues
         */
        private function validateValues(array $arrayValues)
        {

        }

        /**
         * @return \Doctrine\DBAL\Connection
         */
        private function getConnection()
        {
            return $this->connection;
        }
}