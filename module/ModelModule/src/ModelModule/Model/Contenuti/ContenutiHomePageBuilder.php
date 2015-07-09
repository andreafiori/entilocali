<?php

namespace ModelModule\Model\Contenuti;

use ModelModule\Model\Contenuti\ContenutiGetter;
use ModelModule\Model\Contenuti\ContenutiGetterWrapper;
use ModelModule\Model\HomePage\HomePageBuilderAbstract;

class ContenutiHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        $wrapper = $this->recoverWrapperRecordsPaginator(
            new ContenutiGetterWrapper(new ContenutiGetter($em)),
            array('id' => $value['referenceIds']),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );

        return $wrapper->setupRecords();
    }
}
