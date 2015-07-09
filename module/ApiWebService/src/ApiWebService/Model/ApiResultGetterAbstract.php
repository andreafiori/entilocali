<?php

namespace ApiWebService\Model;

/**
 * @author Andrea Fiori
 * @since  23 August 2014
 */
abstract class ApiResultGetterAbstract
{
    protected $entityManager;
    protected $page;
    protected $perPage;
    
    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function setEntityManager(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @return \Doctrine\ORM\EntityManager $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }
    
    /**
     * @param int $page
     */
    public function setPage($page = null)
    {
        if (is_numeric($page)) {
            $this->page = $page;
        }
        
        return $this->page;
    }
    
    /**
     * @param int $perPage
     */
    public function setPerPage($perPage = null)
    {
        if (is_numeric($perPage)) {
            $this->perPage = $perPage;
        }
        
        return $this->perPage;
    }

    /**
     * @return int|null
     */
    public function getPage()
    {
        return $this->page;
    }
    
    /**
     * @return int|null
     */
    public function getPerPage()
    {
        return $this->perPage;
    }
}