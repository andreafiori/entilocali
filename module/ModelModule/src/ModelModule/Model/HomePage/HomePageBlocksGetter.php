<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\QueryBuilderHelperAbstract;

class HomePageBlocksGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("DISTINCT(homePageBlocks.id) AS id, homePageBlocks.position, homePageBlocks.note,
                                     modules.id AS moduleId, modules.name AS moduleName
                                    ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
             ->from('Application\Entity\ZfcmsHomepageBlocks', 'homePageBlocks')
             ->join('homePageBlocks.module', 'modules')
             ->where("homePageBlocks.module = modules.id ");

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('homePageBlocks.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('homePageBlocks.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param $moduleId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleId($moduleId)
    {
        if ( is_numeric($moduleId) ) {
            $this->getQueryBuilder()->andWhere('homePageBlocks.module = :moduleId ');
            $this->getQueryBuilder()->setParameter('moduleId', $moduleId);
        }

        return $this->getQueryBuilder();
    }
}
