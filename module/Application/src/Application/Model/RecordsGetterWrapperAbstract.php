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
    protected $itemsPerPage = 8;

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
     * @param number $page
     * @return \Zend\Paginator\Paginator
     * @throws NullException
     */
    public function setupPaginator($page = 1, $itemsPerPage = null)
    {
        if ( !is_numeric($page) ) {
            $page = 1;
        }
        
        if ( !$itemsPerPage or !is_numeric($itemsPerPage) ) {
            $itemsPerPage = $this->itemsPerPage;
        }
        
        $this->paginator = new Paginator( new ArrayAdapter($this->query) );
        $this->paginator->setCurrentPageNumber($page);
        $this->paginator->setItemCountPerPage($itemsPerPage);
        
        return $this->paginator;
    }
}