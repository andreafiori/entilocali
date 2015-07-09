<?php

namespace ModelModule\Model\HomePage;

use ModelModule\Model\QueryBuilderHelperAbstract;

class HomePageGetter extends QueryBuilderHelperAbstract
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setMainQuery()
    {
        $this->setSelectQueryFields("DISTINCT(homePage.id) AS id, homePage.id AS homepageId, homePage.title, homePage.referenceId,
                                    homePage.freeText, homePage.position, IDENTITY(homePage.language) AS languageId,
                                    IDENTITY(homePage.block) AS blockId,
                                    homePageBlocks.note,

                                    modules.id, modules.name AS moduleName, modules.code AS moduleCode
                                    ");

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsHomepage', 'homePage')
                                ->join('homePage.block', 'homePageBlocks')
                                ->join('homePageBlocks.module', 'modules')
                                ->join('homePage.language', 'languages')
                                ->where("homePageBlocks.module = modules.id
                                        AND homePage.block = homePageBlocks.id
                                        AND homePage.language = languages.id
                                        ");

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

    /**
     * @param $moduleCode
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleCode($moduleCode)
    {
        if ( is_string($moduleCode) ) {
            $this->getQueryBuilder()->andWhere('modules.code = :moduleCode ');
            $this->getQueryBuilder()->setParameter('moduleCode', $moduleCode);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $onylActive
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setOnlyActiveModules($onylActive)
    {
        if ($onylActive == 1) {
            $this->getQueryBuilder()->andWhere('modules.status = 1 ');
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param int $lingua
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguage($language)
    {
        if ( !empty($language) ) {
            $this->getQueryBuilder()->andWhere('homePage.lingua = :lingua ');
            $this->getQueryBuilder()->setParameter('lingua', $language);
        }

        return $this->getQueryBuilder();
    }

    /**
     * Set reference ID for a module element (no foreign key)
     *
     * @param int $referenceId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setReferenceId($referenceId)
    {
        if ( is_numeric($referenceId) ) {
            $this->getQueryBuilder()->andWhere('homePage.referenceId = :referenceId ');
            $this->getQueryBuilder()->setParameter('referenceId', $referenceId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $abbreviation
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageAbbreviation($abbreviation)
    {
        if (!empty($abbreviation)) {
            $this->getQueryBuilder()->andWhere('languages.abbreviation1 = :languageAbbreviation ');
            $this->getQueryBuilder()->setParameter('languageAbbreviation', $abbreviation);
        }

        return $this->getQueryBuilder();
    }
}
