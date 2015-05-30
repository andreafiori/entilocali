<?php

namespace ApiWebService\Model\Resources;

use ModelModule\Model\Posts\PostsGetter;
use ModelModule\Model\Posts\PostsGetterWrapper;
use ApiWebService\Model\ApiResultGetterAbstract;

/**
 * @author Andrea Fiori
 * @since  22 August 2014
 */
class PostsApiResource extends ApiResultGetterAbstract
{
    /**
     * @param array $input
     * @return array
     */
    public function getResourceRecords(array $input)
    {
        $wrapper = new PostsGetterWrapper( new PostsGetter($this->getEntityManager()) );
        $wrapper->setInput($input);
        $wrapper->setupQueryBuilder();
        $wrapper->setupPaginator( $wrapper->setupQuery($this->getEntityManager()) );
        $wrapper->setupPaginatorCurrentPage($this->getPage());
        $wrapper->setupPaginatorItemsPerPage($this->getPerPage());
        
        $paginator = $wrapper->getPaginator();

        $arrayToReturn = array();
        foreach($paginator as $row) {
            $arrayToReturn[] = $row;
        }

        return $arrayToReturn;
    }
}