<?php

namespace ModelModule\Model\SearchEngine;

use ModelModule\Model\ControllerHelperAbstract;
use ModelModule\Model\RecordsGetterWrapperAbstract;

class SearchEngineControllerHelper extends ControllerHelperAbstract
{
    private $searchRecords = array();

    /**
     * @param RecordsGetterWrapperAbstract $wrapper
     * @param $moduleCode
     *
     * @return mixed
     */
    public function setupSearchRecordsWithPaginator(RecordsGetterWrapperAbstract $wrapper, $moduleCode)
    {
        $records = $wrapper->setupRecords();
        if (count($records)) {
            $this->searchRecords[$moduleCode] = $records;
            $this->searchRecords[$moduleCode.'-count'] = $wrapper->getPaginator()->getTotalItemCount();
        }

        return $this->searchRecords;
    }

    /**
     * @return array
     */
    public function getSearchRecords()
    {
        return $this->searchRecords;
    }
}