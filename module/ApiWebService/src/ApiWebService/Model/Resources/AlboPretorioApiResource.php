<?php

namespace ApiWebService\Model\Resources;

use ApiWebService\Model\ApiResultGetterAbstract;
use ModelModule\Model\AlboPretorio\AlboPretorioRecordsGetter;

/**
 * @author Andrea Fiori
 * @since  24 August 2014
 */
class AlboPretorioApiResource extends ApiResultGetterAbstract
{
    /**
     * @param array $input
     * @return array
     */
    public function getResourceRecords(array $input)
    {
        $recordsGetter = new AlboPretorioRecordsGetter($input);
        $recordsGetter->setEntityManager($this->getEntitbyManager());
        $recordsGetter->setArticoliInput($input);
        $recordsGetter->setArticoliPaginator();
        $recordsGetter->setArticoliPaginatorCurrentPage(isset($input['page']) ? $input['page'] : null);
        $recordsGetter->setArticoliPaginatorPerPage(isset($input['perpage']) ? $input['perpage'] : null);

        $paginator = $recordsGetter->getPaginatorRecords();

        $toReturn = array();
        foreach($paginator as $row) {
            $toReturn[] = array_filter($row);
        }

        return $toReturn;
    }
}