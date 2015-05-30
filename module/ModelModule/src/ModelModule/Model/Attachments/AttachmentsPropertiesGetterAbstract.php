<?php

namespace ModelModule\Model\Attachments;

use ModelModule\Model\NullException;
use ModelModule\Model\RecordsGetterWrapperAbstract;

abstract class AttachmentsPropertiesGetterAbstract
{
    /**
     * @var \Application\Model\RecordsGetterWrapperAbstract
     */
    protected $objectWrapper;

    protected $wrapperRecords;

    /**
     * @param RecordsGetterWrapperAbstract $wrapper
     */
    public function setObjectWrapper($wrapper)
    {
        $this->objectWrapper = $wrapper;
    }

    /**
     * @return RecordsGetterWrapperAbstract
     */
    public function getObjectWrapper()
    {
        return $this->objectWrapper;
    }

    /**
     * @throws NullException
     */
    protected function assertObjectWrapper()
    {
        if (!$this->getObjectWrapper()) {
            throw new NullException("Object Wrapper is not set");
        }
    }

    /**
     * @param array $input
     * @return RecordsGetterWrapperAbstract
     */
    public function setupWrapperRecords($input = array())
    {
        $this->objectWrapper->setInput($input);
        $this->objectWrapper->setupQueryBuilder();

        $this->wrapperRecords = $this->objectWrapper->setupRecords();
    }

    /**
     * @return array|null
     */
    public function getWrapperRecords()
    {
        return $this->wrapperRecords;
    }
}
