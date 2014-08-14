<?php

namespace Application\Model;

use Application\Model\NullException;
use Application\Model\QueryBuilderHelperAbstract;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

/**
 * @author Andrea Fiori
 * @since  29 May 2014
 */
abstract class RecordsGetterWrapperAbstract
{
    protected $input;

    protected $objectGetter;
    
    protected $query;
    protected $paginator;
    
    protected $firstResult = 0;
    protected $maxResults = 700;
    protected $perpageDefault = 8;

    /**
     * @param array $input
     */
    public function setInput(array $input)
    {
        $this->input = $input;
        
        return $this->input;
    }
    
    /**
     * 
     * @param string $key
     * @param 0 or 1 or array
     * @return types
     */
    public function getInput($key = null, $noArray = null)
    {
        if ( isset($this->input[$key]) ) {
            return $this->input[$key];
        }
        
        if (!$noArray) {
            return $this->input;
        }
    }
    
    abstract public function setupQueryBuilder();
    
    /**
     * @return type
     */
    public function setObjectGetter(QueryBuilderHelperAbstract $objectGetter)
    {
        $this->objectGetter = $objectGetter;
        
        return $this->objectGetter;
    }
    
    /**
     * @return type
     */
    public function getObjectGetter()
    {
        return $this->objectGetter;
    }

    /**
     * @return \Application\Model\QueryBuilderHelperAbstract
     * @throws NullException
     */
    public function getRecords()
    {
        if (!$this->objectGetter) {
            throw new NullException("ObjectGetter is not set");
        }
        
        return $this->objectGetter->getQueryResult();
    }
    
    /**
     * @param array $queryRecords
     * @return type
     */
    public function setupPaginator(array $queryRecords)
    {
        $this->paginator = new Paginator( new ArrayAdapter($queryRecords) );

        return $this->paginator;
    }
    
    /**
     * @param int $page
     * @return type
     */
    public function setupPaginatorCurrentPage($page = 1)
    {
        $this->assertPaginator();
        
        if ( !is_numeric($page) ) {
            $page = 1;
        }
        
        $this->paginator->setCurrentPageNumber($page);
        
        return $this->paginator;
    }
    
    /**
     * @param int $perpage
     * @return type
     */
    public function setupPaginatorItemsPerPage($perpage = null)
    {
        $this->assertPaginator();
        
        if ( !is_numeric($perpage) ) {
            $perpage = $this->perpageDefault;
        }
        
        $this->paginator->setItemCountPerPage($perpage);
        
        return $this->paginator;
    }
    
        /**
         * @throws NullException
         */
        private function assertPaginator()
        {
            if (!$this->paginator) {
                throw new NullException('Zend Paginator must be set. Use setupPaginator first');
            }
        }
        
    /**
     * Query must be set using entity manager and scalarResult on child classes
     * 
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    /**
     * @return \Zend\Paginator\Paginator $paginator
     */
    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getFirstResult()
    {
        return $this->firstResult;
    }

    public function getMaxResults()
    {
        return $this->maxResults;
    }
}