<?php

namespace ModelModule\Model\StatoCivile;

use ModelModule\Model\StatoCivile\StatoCivileGetter;
use ModelModule\Model\StatoCivile\StatoCivileGetterWrapper;
use ModelModule\Model\HomePage\HomePageBuilderAbstract;

class StatoCivileHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        $wrapper = $this->recoverWrapperRecordsPaginator(
            new StatoCivileGetterWrapper(new StatoCivileGetter($em)),
            array('id' => $value['referenceIds']),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );

        return $wrapper->setupRecords();
    }
}