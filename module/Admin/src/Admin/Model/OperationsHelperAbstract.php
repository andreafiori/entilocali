<?php

namespace Admin\Model;

use Application\Model\NullException;
use Doctrine\DBAL\Connection;

/**
 * @author Andrea Fiori
 * @since  14 April 2015
 */
abstract class OperationsHelperAbstract
{
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function setConnection(Connection $connection)
    {
        $this->connection = $connection;
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
    protected function assertConnection()
    {
        if (!$this->getConnection()) {
            throw new NullException("Connection db instance is not set");
        }
    }
}