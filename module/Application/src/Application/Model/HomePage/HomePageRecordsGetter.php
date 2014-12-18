<?php

namespace Application\Model\HomePage;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  22 June 2014
 */
class HomePageRecordsGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('h.referenceId, h.position, h.freeText, IDENTITY(hb.module) AS moduleId ');

        $this->getQueryBuilder()->select($this->getSelectQueryFields())
                                ->from('Application\Entity\ZfcmsHomepage', 'h')
                                ->join('h.block', 'hb')
                                ->join('hb.module', 'm')
                                ->where(" (hb.module = m.id AND h.block = hb.id) ");

        return $this->getQueryBuilder();
    }
}
