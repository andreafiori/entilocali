<?php

namespace ModelModule\Model\AlboPretorio;

use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetter;
use ModelModule\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;
use ModelModule\Model\HomePage\HomePageBuilderAbstract;

class AlboPretorioHomePageBuilder extends HomePageBuilderAbstract
{
    public function recoverHomePageElements()
    {
        $this->assertEntityManager();
        $this->assertModuleRelatedRecords();

        $em = $this->getEntityManager();

        $value = $this->getModuleRelatedRecords();

        $wrapper = $this->recoverWrapperRecordsPaginator(
            new AlboPretorioArticoliGetterWrapper(new AlboPretorioArticoliGetter($em)),
            array('id' => $value['referenceIds'], 'orderBy' => 'alboArticoli.id'),
            $this->currentPaginatorPage,
            $this->maxPaginatorItemsPerPage
        );

        return $wrapper->setupRecords();
    }
}