<?php

namespace Application\Controller\HomePage;

use Admin\Model\AlboPretorio\AlboPretorioArticoliGetter;
use Admin\Model\AlboPretorio\AlboPretorioArticoliGetterWrapper;

/**
 * @author Andrea Fiori
 * @since  16 April 2015
 */
class AlboPretorioHomePageBuilder extends HomePageBuilderAbstract
{
    public function setupWrapperRecords()
    {

    }

    protected function assertObjectWrapper()
    {
        if (!$this->getObjectWrapper()) {
            $this->objectWrapper = new AlboPretorioArticoliGetterWrapper(
                new AlboPretorioArticoliGetter($this->getEntityManager())
            );
        }
    }
}