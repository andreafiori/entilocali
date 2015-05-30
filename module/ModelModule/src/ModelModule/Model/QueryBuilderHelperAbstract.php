<?php

namespace ModelModule\Model;

/**
 * Help classes with db queries to set common parameters
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
abstract class QueryBuilderHelperAbstract
{
    /**
     * @var \Doctrine\ORM\EntityManager  
     */
    protected $entityManager;
    
    protected $queryBuilder;
    protected $selectQueryFields;
    
    protected $maxResults = 770;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;

        $config = $this->entityManager->getConfiguration();
        $config->addCustomDatetimeFunction('DATE_FORMAT', "\\ModelModule\\Model\\Doctrine\\Functions\\DateFormat");
        $config->addCustomDatetimeFunction('MONTH', "\\ModelModule\\Model\\Doctrine\\Functions\\Month");
        $config->addCustomDatetimeFunction('MD5', "\\ModelModule\\Model\\Doctrine\\Functions\\Md5");

        $this->queryBuilder = $this->entityManager->createQueryBuilder();
    }
    
    /**
     * @return \Doctrine\ORM\Query
     */
    public function getQuery()
    {
        return $this->getQueryBuilder()->getQuery();
    }
    
    /**
     * Get DQL query string
     * 
     * @return string
     */
    public function getDQLQuery()
    {
        return $this->getQueryBuilder()->getQuery()->getDQL();
    }
    
    /**
     * Query result recordset
     * 
     * @return mixed
     */
    public function getQueryResult()
    {
        return $this->getQueryBuilder()->getQuery()->getResult();
    }

    /**
     * Return the QueryBuilder object
     * 
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    /**
     * @param string $stringFields
     */
    public function setSelectQueryFields($stringFields = '')
    {
        if (!$this->selectQueryFields) {
            $this->selectQueryFields = $stringFields;
        }
        
        return $this->selectQueryFields;
    }
    
    /**
     * @return string or null
     */
    public function getSelectQueryFields()
    {
        return $this->selectQueryFields;
    }

    /**
     * @param string $orderBy
     * @param string $defaultField
     * @return string
     */
    public function setOrderBy($orderBy = null, $defaultField = null)
    {
        return $this->bindWithDefaultParameter($orderBy, 'orderBy', $defaultField);
    }
    
    /**
     * 
     * @param string $groupBy
     * @param string $defaultField
     * @return string
     */
    public function setGroupBy($groupBy = null, $defaultField = null)
    {
        return $this->bindWithDefaultParameter($groupBy, 'groupBy', $defaultField);
    }
    
        /**
         * @param string $parameter
         * @param string $parameterString
         * @param string $defaultField
         * @return string
         */
        private function bindWithDefaultParameter($parameter = null, $parameterString = null, $defaultField = null)
        {
            if (!$parameter) {
                $parameter = $defaultField;
            }

            if ($parameter) {
                $this->getQueryBuilder()->add($parameterString, $parameter);
            }

            return $this->getQueryBuilder();
        }
    
    /**
     * @param  number $limit
     * @return number
     */
    public function setLimit($limit = null)
    {
        if ( is_numeric($limit) ) {
            $this->maxResults = $limit;
            
            $this->getQueryBuilder()->setMaxResults($this->maxResults);
        }

        return $this->maxResults;
    }
}
