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

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        
        $this->queryBuilder = $this->entityManager->createQueryBuilder();
    }
    
    /**
     * Get DQL query string
     * 
     * @return string
     */
    public function getQuery()
    {
        return $this->getQueryBuilder()->getQuery()->getDQL();
    }
    
    public function getQueryResult()
    {
        $this->getQueryBuilder()->setFirstResult(0);
        $this->getQueryBuilder()->setMaxResults(300);
        
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
}
