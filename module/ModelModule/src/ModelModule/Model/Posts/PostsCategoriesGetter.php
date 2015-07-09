<?php

namespace ModelModule\Model\Posts;

use ModelModule\Model\QueryBuilderHelperAbstract;

class PostsCategoriesGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(category.id) AS id, category.name, category.description,
                                    category.seoKeywords, category.seoDescription,
                                    category.createDate, category.status,
                                    IDENTITY(category.module) AS moduleId,
                                    module.name AS moduleName
                                    ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsPostsCategories', 'category')
                                ->join('category.module', 'module')
                                ->join('category.language', 'language')
                                ->where('category.module = module.id ');

        return $this->getQueryBuilder();
    }

    /**
     * @param int $id
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('category.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
        
        if (is_array($id)) {
            $this->getQueryBuilder()->andWhere('category.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param number $channel
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setChannelId($channel = null)
    {
        if ( is_numeric($channel) ) {
            $this->getQueryBuilder()->andWhere('category.module = :moduleId ');
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param number $moduleId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleId($moduleId = null)
    {
        if (is_numeric($moduleId)) {
            $this->getQueryBuilder()->andWhere('category.module = :moduleId ');
            $this->getQueryBuilder()->setParameter('moduleId', $moduleId);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $status
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('category.status IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("category.status = :status ");
            $this->getQueryBuilder()->setParameter('status', $status);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $moduleCode
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setModuleCode($moduleCode = null)
    {
        if (!empty($moduleCode)) {
            $this->getQueryBuilder()->andWhere('module.code = :moduleCode ');
            $this->getQueryBuilder()->setParameter('moduleCode', $moduleCode);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $slug
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setSlug($slug)
    {
        if ( !empty($slug) ) {
            $this->getQueryBuilder()->andWhere('category.slug = :slug ');
            $this->getQueryBuilder()->setParameter('slug', $slug);
        }

        return $this->getQueryBuilder();
    }

    /**
     * @param string $langAbbr
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function setLanguageAbbreviation($langAbbr)
    {
        if (!empty($langAbbr)) {
            $this->getQueryBuilder()->andWhere('language.abbreviation1 = :languageAbbr ');
            $this->getQueryBuilder()->setParameter('languageAbbr', $langAbbr);
        }

        return $this->getQueryBuilder();
    }
}
