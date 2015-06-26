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
        $contenutiRecords = $wrapper->setupRecords();
        if (count($contenutiRecords)) {
            $this->searchRecords[$moduleCode] = $contenutiRecords;
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