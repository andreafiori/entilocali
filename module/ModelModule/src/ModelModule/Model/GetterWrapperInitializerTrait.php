<?php

namespace ModelModule\Model;

use ModelModule\Model\RecordsGetterWrapperAbstract;

trait PostGetterWrapperInitializerTrait
{
    private $wrapper;

    /**
     * @param RecordsGetterWrapperAbstract $wrapper
     * @param array $input
     * @return RecordsGetterWrapperAbstract
     */
    protected function setupWrapper(RecordsGetterWrapperAbstract $wrapper, array $input)
    {
        $this->wrapper = $wrapper;

        $this->wrapper->setInput($input);

        $this->wrapper->setupQueryBuilder();

        return $this->wrapper;
    }

    /**
     * @param RecordsGetterWrapperAbstract $wrapper
     * @return mixed
     */
    protected function setupWrapperWithPaginator(RecordsGetterWrapperAbstract $wrapper, $input, $page = null, $perPage = null)
    {
        $this->wrapper = $wrapper;

        $this->wrapper->setupPaginator( $wrapper->setupQuery($wrapper->getObjectGetter()->getEntityManager()) );
        $this->wrapper->setupPaginatorCurrentPage($page);
        $this->wrapper->setupPaginatorItemsPerPage($perPage);

        return $this->wrapper;
    }
}
