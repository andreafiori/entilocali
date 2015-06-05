<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\OperationsModelAbstract;
use ModelModule\Model\NullException;

abstract class HomePageBuilderAbstract extends OperationsModelAbstract
{
    protected $currentPaginatorPage = 1;
    
    protected $maxPaginatorItemsPerPage = 35;

    protected $wrapper;

    protected $wrapperRecords;

    protected $moduleRelatedRecords;

    /**
     * @return array
     */
    public function getWrapperRecords()
    {
        return $this->wrapperRecords;
    }

    /**
     * @param mixed $moduleRelatedRecords
     */
    public function setModuleRelatedRecords($moduleRelatedRecords)
    {
        $this->moduleRelatedRecords = $moduleRelatedRecords;
    }

    /**
     * @return mixed
     */
    public function getModuleRelatedRecords()
    {
        return $this->moduleRelatedRecords;
    }

    /**
     * @throws NullException
     */
    protected function assertModuleRelatedRecords()
    {
        if (!$this->getModuleRelatedRecords()) {
            throw new NullException("ModuleRelatedRecords is not set");
        }
    }
}