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
    
    protected function getQueryBuilder()
    {
        return $this->queryBuilder;
    }
    
    /**
     * @param number $channel
     */
    public function setChannelId($channel = null)
    {
        $this->getQueryBuilder()->setParameter('channel', \is_numeric($channel) ? $channel : 1);
    }
    
    /**
     * @param number $languageId
     */
    public function setLanguageId($languageId = null)
    {
        $this->getQueryBuilder()->setParameter('language', \is_numeric($languageId) ? $languageId : 1);
    }
    
}
