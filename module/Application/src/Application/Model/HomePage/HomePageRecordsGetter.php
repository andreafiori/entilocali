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

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('h.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('h.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $moduleCode
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleCode($moduleCode)
    {
        if ( is_string($moduleCode) ) {
            $this->getQueryBuilder()->andWhere('m.code = :moduleCode ');
            $this->getQueryBuilder()->setParameter('moduleCode', $moduleCode);
        }

        return $this->getQueryBuilder();
    }
}
