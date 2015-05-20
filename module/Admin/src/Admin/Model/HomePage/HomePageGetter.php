<?php

namespace Admin\Model\HomePage;

use Application\Model\QueryBuilderHelperAbstract;

class HomePageGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields("DISTINCT(homePage.id) AS id, homePage.title,

                                    homePageBlocks.note, modules.id, modules.name AS moduleName
                                    ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsHomepage', 'homePage')
                                ->join('homePage.block', 'homePageBlocks')
                                ->join('homePageBlocks.module', 'modules')
                                ->where("homePageBlocks.module = modules.id AND homePage.block = homePageBlocks.id ");

        return $this->getQueryBuilder();
    }

    /**
     * @param int|array $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('homePage.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('homePage.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }
}
