<?php

namespace Application\Model;

/**
 * Help classes with db queries to set common parameters
 * 
 * @author Andrea Fiori
 * @since  15 April 2014
 */
abstract class QueryBuilderHelperAbstract
{
    protected $entityManager;
    protected $queryBuilder;
    protected $firstResult = 0;
    protected $maxResults = 300;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        
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
     * @return type
     */
    public function getQueryResult()
    {
        $this->getQueryBuilder()->setFirstResult($this->firstResult);
        $this->getQueryBuilder()->setMaxResults($this->maxResults);
        
        return $this->getQueryBuilder()->getQuery()->getResult();
    }

    /**
     * Return the QueryBuilder object
     * 
     * @return \Doctrine\ORM\QueryBuilder $this->queryBuilder
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
}
