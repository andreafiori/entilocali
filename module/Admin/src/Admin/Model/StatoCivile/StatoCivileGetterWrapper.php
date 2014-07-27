<?php

namespace Admin\Model\StatoCivile;

use Application\Model\RecordsGetterWrapperAbstract;
use Admin\Model\StatoCivile\StatoCivileGetter;

/**
 * @author Andrea Fiori
 * @since  17 June 2013
 */
class StatoCivileGetterWrapper extends RecordsGetterWrapperAbstract
{
    private $statoCivileGetter;

    /**
     * @param \Admin\Model\StatoCivile\StatoCivileGetter $statoCivileGetter
     */
    public function __construct(StatoCivileGetter $statoCivileGetter)
    {
        $this->statoCivileGetter = $statoCivileGetter;
    }
    
    public function setupQueryBuilder()
    { 
        $this->statoCivileGetter->setSelectQueryFields( $this->getInput('fields', 1) );

        $this->statoCivileGetter->setMainQuery();
        
        $this->statoCivileGetter->setId( $this->getInput('id', 1) );
        //$this->statoCivileGetter->setOrderBy( $this->getInput('orderby', 1) );
        //$this->statoCivileGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * Setup query (for paginator)
     */
    public function setupQuery(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->query = $entityManager->createQuery( $this->statoCivileGetter->getDQLQuery() )
                                ->setFirstResult($this->firstResult)
                                ->setMaxResults($this->maxResult)
                                ->setParameters( $this->statoCivileGetter->getQuery()->getParameters() )
                                ->getScalarResult();

        return $this->query;
    }
    
    /**
     * @return array
     */
    public function getRecords()
    {
        return $this->statoCivileGetter->getQueryResult();
    }
}