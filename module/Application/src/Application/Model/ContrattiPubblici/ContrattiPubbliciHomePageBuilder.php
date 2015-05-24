<?php

namespace Application\Model\ContrattiPubblici;

use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetter;
use Admin\Model\ContrattiPubblici\ContrattiPubbliciGetterWrapper;
use Application\Model\HomePage\HomePageBuilderAbstract;

class ContrattiPubbliciHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        $wrapper = $this->recoverWrapperRecordsPaginator(
            new ContrattiPubbliciGetterWrapper(new ContrattiPubbliciGetter($em)),
            array('id' => $value['referenceIds']),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );

        return $wrapper->setupRecords();
    }
}