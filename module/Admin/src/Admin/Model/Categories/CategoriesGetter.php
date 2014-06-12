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
        $this->setSelectQueryFields('DISTINCT(c.id) AS id, co.name, c.createDate, c.status, IDENTITY(c.module) AS module');

        $this->getQueryBuilder()->add('select', $this->getSelectQueryFields())
                                ->add('from', 'Application\Entity\Categories c, Application\Entity\CategoriesOptions co')
                                ->add('where', 'co.category = c.id ');

        return $this->getQueryBuilder();
    }
    
    /**
     * @param number or array $id
     * @return type
     */
    public function setId($id)
    {
        if ( is_numeric($id) ) {
            $this->getQueryBuilder()->andWhere('c.id = :id ');
            $this->getQueryBuilder()->setParameter('id', $id);
        } elseif (is_array($id)) {
            $this->getQueryBuilder()->andWhere('c.id IN ( :id ) ');
            $this->getQueryBuilder()->setParameter('id', $id);
        }
    }
    
    /**
     * @param number $channel
     */
    public function setChannelId($channel = null)
    {
        if (is_numeric($channel)) {
            $this->getQueryBuilder()->setParameter('channel', $channel);
        }
    }
    
    /**
     * @param number $moduleId
     */
    public function setModuloId($moduleId = null)
    {
        if (is_numeric($moduleId)) {
            $this->getQueryBuilder()->andWhere('c.module = :moduleId ');
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
     * Set posts status
     * 
     * @param string or null $status
     */
    public function setStatus($status = null)
    {
        if ($status == 'NULL' or $status == 'null') {
            $this->getQueryBuilder()->andWhere('c.status IS NULL ');
        } elseif ($status != null) {
            $this->getQueryBuilder()->andWhere("c.status = '$status' ");
        }
    }
    
    /**
     * @param string $orderBy
     */
    public function setOrderBy($orderBy = null)
    {
        if (!$orderBy) {
            $orderBy = 'co.position';
        }
        
        $this->getQueryBuilder()->add('orderBy', $orderBy);
    }
}
