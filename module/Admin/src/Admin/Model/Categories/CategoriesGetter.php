<?php

namespace Admin\Model\Categories;

use Application\Model\QueryBuilderHelperAbstract;

/**
 * @author Andrea Fiori
 * @since  15 April 2014
 */
class CategoriesGetter extends QueryBuilderHelperAbstract
{
    public function setMainQuery()
    {
        $this->setSelectQueryFields('DISTINCT(category.id) AS id, co.name, co.description, 
                co.seoKeywords, co.seoDescription,
                category.createDate, category.status, 
                IDENTITY(category.module) AS module
                ');

        $this->getQueryBuilder()->select( $this->getSelectQueryFields() )
                                ->from('Application\Entity\ZfcmsCategoriesOptions', 'co')
                                ->join('co.category', 'category')
                                ->where('co.category = category.id ');

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
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
    }
    
    /**
     * @param number $channel
     */
    public function setChannelId($channel = null)
    {
        if ( is_numeric($channel) ) {
            $this->getQueryBuilder()->andWhere('category.module = :moduleId ');
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }
    }
    
    /**
     * @param number $moduleId
     */
    public function setModuleId($moduleId = null)
    {
        if (is_numeric($moduleId)) {
            $this->getQueryBuilder()->andWhere('category.module = :moduleId ');
            $this->getQueryBuilder()->setParameter('moduleId', $moduleId);
        }
    }
    
    /**
     * @param number $languageId
     */
    public function setLanguageId($languageId = null)
    {
        if (is_numeric($languageId)) {
            $this->getQueryBuilder()->setParameter('language', $languageId);
        }
    }
    
    /**
     * @param string or null $status
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('category.status IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("category.status = :status ");
            $this->getQueryBuilder()->setParameter('status', $status);
        }
    }
}
