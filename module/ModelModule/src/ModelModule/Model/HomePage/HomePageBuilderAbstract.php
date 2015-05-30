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
     * @param \Application\Model\RecordsGetterAbstract $wrapper
     */
    public function setWrapper($wrapper)
    {
        $this->wrapper = $wrapper;

        return $this->wrapper;
    }

    /**
     * @return \Application\Model\RecordsGetterAbstract
     */
    public function getWrapper()
    {
        return $this->wrapper;
    }
    
    protected function assertWrapper()
    {
        if (!$this->getwrapper()) {
            throw new NullException("Wrapper object is not set");
        }
    }

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

    protected function assertModuleRelatedRecords()
    {
        if (!$this->getModuleRelatedRecords()) {
            throw new NullException("ModuleRelatedRecords is not set");
        }
    }
}