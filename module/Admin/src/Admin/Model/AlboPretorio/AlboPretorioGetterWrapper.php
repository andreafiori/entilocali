<?php

namespace Admin\Model\AlboPretorio;

use Application\Model\RecordsGetterWrapperAbstract;

/**
 * @author Andrea Fiori
 * @since  08 July 2014
 */
class AlboPretorioGetterWrapper extends RecordsGetterWrapperAbstract
{
    /** @var \Admin\Model\AlboPretorio\AlboPretorioGetter Description **/
    protected $objectGetter;

    /**
     * @param \Admin\Model\AlboPretorio\AlboPretorioGetter $alboPretorioGetter
     */
    public function __construct(AlboPretorioGetter $alboPretorioGetter)
    {
        $this->setObjectGetter( $alboPretorioGetter );
    }
    
    /**
     * setup and execute query
     */
    public function setupQueryBuilder()
    {        
        $this->objectGetter->setSelectQueryFields( $this->getInput('fields', 1) );
        
        $this->objectGetter->setMainQuery();
        
        $this->objectGetter->setId( $this->getInput('id', 1) );
        $this->objectGetter->setOrderBy( $this->getInput('orderBy', 1) );
        $this->objectGetter->setLimit( $this->getInput('limit', 1) );
    }
    
    /**
     * Setup and execute query for the pagination
     * 
     * @param \Doctrine\ORM\EntityManager $entityManager
     * @return array
     */
    public function setupQuery(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->query = $entityManager->createQuery( $this->objectGetter->getDQLQuery() )
                                ->setFirstResult($this->firstResult)
                                ->setMaxResults($this->maxResults)
                                ->setParameters( $this->objectGetter->getQuery()->getParameters() )
                                ->getScalarResult();

        return $this->query;
    }
}
