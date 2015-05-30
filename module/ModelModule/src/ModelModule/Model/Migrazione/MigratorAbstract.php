<?php

namespace ModelModule\Model\Migrazione;

use ModelModule\Model\InputSetterGetterAbstract;
use ModelModule\Model\Logs\LogWriter;
use ModelModule\Model\Database\Redbean\RedbeanHelper;
use ModelModule\Model\NullException;

/**
 * @author Andrea Fiori
 * @since  21 February 2015
 */
abstract class MigratorAbstract extends InputSetterGetterAbstract
{
    private $logWriter;

    private $redbeanHelper;

    private $userDetails;

    /**
     * @param array $input
     */
    public function __construct(array $input)
    {
        $this->setInput($input);
    }

    /**
     * @param LogWriter $LogWriter
     */
    public function setLogWriter(LogWriter $LogWriter)
    {
        $this->logWriter = $LogWriter;
    }

    /**
     * @return LogWriter
     */
    public function getLogWriter()
    {
        return $this->logWriter;
    }

    /**
     * @param RedbeanHelper $redbeanHelper
     */
    public function setRedbeanHelper(RedbeanHelper $redbeanHelper)
    {
        $this->redbeanHelper = $redbeanHelper;
    }

    /**
     * @return RedbeanHelper
     */
    public function getRedbeanHelper()
    {
        return $this->redbeanHelper;
    }

    /**
     * @param \stdClass $userDetails
     */
    public function setUserDetails($userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * @return \stdClass|null
     */
    public function getUserDetails()
    {
        return $this->userDetails;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getUserDetailsKey($key)
    {
        if (isset($this->userDetails->$key)) {
            return $this->userDetails->$key;
        }
    }

    /**
     * @throws NullException
     */
    public function assertRedbeanHelper()
    {
        if (!$this->getRedbeanHelper()) {
            throw new NullException('RedbeanHelper is not set');
        }
    }

    /**
     * @throws NullException
     */
    public function assertLogWriter()
    {
        if (!$this->getLogWriter()) {
            throw new NullException('LogWriter is not set');
        }
    }

    /**
     * @param int $value
     */
    public function setForeignKeyChecks($value)
    {
        return $this->getRedbeanHelper()->executeQuery("SET foreign_key_checks = $value");
    }

    /**
     * Perform database data migration
     *
     * @return mixed
     */
    abstract public function migrate();

    /**
     * Log operation
     *
     * @return mixed
     */
    abstract public function log();
}
