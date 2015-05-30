<?php

namespace ModelModule\Model\AttiConcessione;

use ModelModule\Model\AttiConcessione\AttiConcessioneGetter;
use ModelModule\Model\AttiConcessione\AttiConcessioneGetterWrapper;
use ModelModule\Model\HomePage\HomePageBuilderAbstract;

class AttiConcessioneHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        $wrapper = $this->recoverWrapperRecordsPaginator(
            new AttiConcessioneGetterWrapper(new AttiConcessioneGetter($em)),
            array('id' => $value['referenceIds']),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );

        return $wrapper->setupRecords();
    }
}